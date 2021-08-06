<?php

namespace App\Controller;

use App\Entity\Article;
use App\Helpers;
use App\Http\Request;
use App\Http\Session;
use App\Hydrator;
use App\Repository\ArticlesRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Service\FileUploader;
use App\Validator\Validator;
use Twig\Environment;

class ArticlesController extends AbstractController
{
    private ArticlesRepository $repository;
    private CommentRepository $commentRepository;
    private Hydrator $hydrator;
    private Validator $validator;
    private Helpers $helpers;
    private FileUploader $fileUploader;

    public function __construct(Environment $twig, Request $request, Session $session)
    {
        $this->repository = new ArticlesRepository();
        $this->commentRepository = new CommentRepository();
        $this->hydrator = new Hydrator();
        $this->validator = new Validator();
        $this->helpers = new Helpers();
        $this->fileUploader = new FileUploader(['image/png', 'image/jpeg', '.image/jpg']);
        parent::__construct($twig, $request, $session);
    }

    public function index()
    {
        $articles = $this->repository->getAll(['updatedDate' => 'DESC']);

        return $this->render('articles.html.twig', ['articles' => $articles]);
    }

    public function show(int $id)
    {
        $article = $this->repository->getOne($id);
        $comments = $this->commentRepository->getArticleComments($id);

        if (!$article) {
            return $this->render('404.html.twig');
        }

        return $this->render('article_detail.html.twig', ['article' => $article, 'comments' => $comments]);
    }

    public function new()
    {
        if (is_null($this->session->get('user')) || $this->session->get('user')->getRole() !== 'admin') {
            return $this->render('404.html.twig');
        }

        $categoryRepo = new CategoryRepository();
        $categories = $categoryRepo->getAll();

        if (empty($this->request->getPostParams())) {
            return $this->render('admin/new_article.html.twig', ['categories' => $categories]);
        }

        $article = new Article();

        $article->setAuthor($this->session->get('user'));
        $article->setTrending($this->request->getPostParam('trending') ? 1 : 0);

        $errors = $this->validator->validate($article, $this->request->getPostParams());
        $upload = $this->fileUploader->upload($_FILES['thumbnailUrl']);

        if (!empty($errors) || is_array($upload)) {
            return $this->render('admin/new_article.html.twig', [
                'errors'     => array_merge($errors, $upload),
                'post'       => $this->request->getPostParams(),
                'categories' => $categories,
            ]);
        }

        $this->request->setPostParam('category', $categoryRepo->getById((int) $this->request->getPostParams('category')));

        $this->hydrator->hydrate($article, $this->request->getPostParams());

        $article->setSlug($this->helpers->slugify($article->getTitle()));
        $article->setThumbnailUrl("/images/$upload");

        if (!$this->repository->add($article)) {
            return $this->render('admin/new_article.html.twig', [
                'error'      => "Une erreur s'est produite pendant la publication de l'article, veuillez réessayer.",
                'categories' => $categories,
            ]);
        }

        return $this->render('admin/new_article.html.twig', [
            'message'    => 'Votre article a bien été publié',
            'categories' => $categories,
        ]);
    }

    public function manageArticles()
    {
        if (is_null($this->session->get('user')) || $this->session->get('user')->getRole() !== 'admin') {
            return $this->render('404.html.twig');
        }

        $articles = $this->repository->getAll(['updatedDate' => 'DESC']);

        return $this->render('admin/list_articles.html.twig', ['articles' => $articles]);
    }

    public function delete()
    {
        if (is_null($this->session->get('user')) || $this->session->get('user')->getRole() !== 'admin') {
            return $this->render('404.html.twig');
        }

        if ($this->request->getPostParam('articleId') === null || $this->request->getPostParam('thumbnailUrl') === null) {
            return;
        }

        if (!$this->repository->delete($this->request->getPostParam('articleId'))) {
            // TODO : Faire passer un message d'erreur
            return $this->redirect('/admin/list-articles');
        }

        $this->fileUploader->remove($this->request->getPostParam('thumbnailUrl'));

        // TODO : Faire passer un message de confirmation
        return $this->redirect('/admin/list-articles');
    }

    public function update(int $id)
    {
        if (is_null($this->session->get('user')) || $this->session->get('user')->getRole() !== 'admin') {
            return $this->render('404.html.twig');
        }

        $article = $this->repository->getOne((int) $id);

        $categoryRepo = new CategoryRepository();
        $categories = $categoryRepo->getAll();

        if (empty($this->request->getPostParams())) {
            return $this->render('admin/update_article.html.twig', ['article' => $article, 'categories' => $categories]);
        }

        $newArticle = new Article();

        $newArticle->setAuthor($this->session->get('user'));
        $newArticle->setTrending($this->request->getPostParam('trending') ? 1 : 0);

        $errors = $this->validator->validate($newArticle, $this->request->getPostParams());

        if (!empty($errors)) {
            return $this->render('admin/update_article.html.twig', [
                'errors'     => $errors,
                'article'    => $this->request->getPostParams(),
                'categories' => $categories,
            ]);
        }

        $this->request->setPostParam('category', $categoryRepo->getById((int) $this->request->getPostParams('category')));

        if (isset($_FILES['thumbnailUrl']['size']) && $_FILES['thumbnailUrl']['size'] > 0) {
            // Supprimer l'ancienne image
            $this->fileUploader->remove($article->getThumbnailUrl());

            $upload = $this->fileUploader->upload($_FILES['thumbnailUrl']);

            if (is_array($upload)) {
                return $this->render('admin/update_article.html.twig', [
                    'errors'     => $upload,
                    'article'    => $this->request->getPostParams(),
                    'categories' => $categories,
                ]);
            }

            $newArticle->setThumbnailUrl("/images/$upload");
        } else {
            $newArticle->setThumbnailUrl($article->getThumbnailUrl());
        }

        $this->hydrator->hydrate($newArticle, $this->request->getPostParams());

        $newArticle->setSlug($this->helpers->slugify($article->getTitle()));
        $newArticle->setId($article->getId());

        if (!$this->repository->update($newArticle)) {
            return $this->render('admin/update_article.html.twig', [
                'error'      => "Une erreur s'est produite pendant la modification de l'article, veuillez réessayer.",
                'categories' => $categories,
                'article'    => $this->request->getPostParams(),
            ]);
        }

        return $this->render('admin/update_article.html.twig', [
            'message'    => 'Votre article a bien été mis à jour',
            'categories' => $categories,
            'article'    => $newArticle,
        ]);
    }
}
