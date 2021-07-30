<?php

namespace App\Controller;

use App\Entity\Article;
use App\Helpers;
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

    public function __construct(Environment $twig)
    {
        $this->repository = new ArticlesRepository();
        $this->commentRepository = new CommentRepository();
        $this->hydrator = new Hydrator();
        $this->validator = new Validator();
        $this->helpers = new Helpers();
        $this->fileUploader = new FileUploader(['image/png', 'image/jpeg', '.image/jpg']);
        parent::__construct($twig);
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
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== 'admin') {
            return $this->render('404.html.twig');
        }

        $categoryRepo = new CategoryRepository();
        $categories = $categoryRepo->getAll();

        if (empty($_POST)) {
            return $this->render('admin/new_article.html.twig', ['categories' => $categories]);
        }

        $article = new Article();

        $article->setAuthor($_SESSION['user']);
        $article->setTrending($_POST['trending'] ? 1 : 0);

        $errors = $this->validator->validate($article, $_POST);
        $upload = $this->fileUploader->upload($_FILES['thumbnailUrl']);

        if (!empty($errors) || is_array($upload)) {
            return $this->render('admin/new_article.html.twig', [
                'errors'     => array_merge($errors, $upload),
                'post'       => $_POST,
                'categories' => $categories,
            ]);
        }

        $_POST['category'] = $categoryRepo->getById((int) $_POST['category']);
        $this->hydrator->hydrate($article, $_POST);

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
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== 'admin') {
            return $this->render('404.html.twig');
        }

        $articles = $this->repository->getAll(['updatedDate' => 'DESC']);

        return $this->render('admin/list_articles.html.twig', ['articles' => $articles]);
    }

    public function delete()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== 'admin') {
            return $this->render('404.html.twig');
        }

        if (!isset($_POST['articleId'], $_POST['thumbnailUrl'])) {
            return;
        }

        if (!$this->repository->delete($_POST['articleId'])) {
            // TODO : Faire passer un message d'erreur
            return $this->redirect('/admin/list-articles');
        }

        $this->fileUploader->remove("/public{$_POST['thumbnailUrl']}");

        // TODO : Faire passer un message de confirmation
        return $this->redirect('/admin/list-articles');
    }

    public function update(int $id)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== 'admin') {
            return $this->render('404.html.twig');
        }

        $article = $this->repository->getOne((int) $id);

        $categoryRepo = new CategoryRepository();
        $categories = $categoryRepo->getAll();

        if (empty($_POST)) {
            return $this->render('admin/update_article.html.twig', ['article' => $article, 'categories' => $categories]);
        }

        $newArticle = new Article();

        $newArticle->setAuthor($_SESSION['user']);
        $newArticle->setTrending($_POST['trending'] ? 1 : 0);

        $errors = $this->validator->validate($newArticle, $_POST);

        if (!empty($errors)) {
            return $this->render('admin/update_article.html.twig', [
                'errors'     => $errors,
                'article'    => $_POST,
                'categories' => $categories,
            ]);
        }

        $_POST['category'] = $categoryRepo->getById((int) $_POST['category']);

        if (isset($_FILES['thumbnailUrl']['size']) && $_FILES['thumbnailUrl']['size'] > 0) {
            // Supprimer l'ancienne image
            $this->fileUploader->remove($article->getThumbnailUrl());

            $upload = $this->fileUploader->upload($_FILES['thumbnailUrl']);

            if (is_array($upload)) {
                return $this->render('admin/update_article.html.twig', [
                    'errors'     => $upload,
                    'article'    => $_POST,
                    'categories' => $categories,
                ]);
            }

            $newArticle->setThumbnailUrl("/images/$upload");
        } else {
            $newArticle->setThumbnailUrl($article->getThumbnailUrl());
        }

        $this->hydrator->hydrate($newArticle, $_POST);

        $newArticle->setSlug($this->helpers->slugify($article->getTitle()));
        $newArticle->setId($article->getId());

        if (!$this->repository->update($newArticle)) {
            return $this->render('admin/update_article.html.twig', [
                'error'      => "Une erreur s'est produite pendant la modification de l'article, veuillez réessayer.",
                'categories' => $categories,
                'article'    => $_POST,
            ]);
        }

        return $this->render('admin/update_article.html.twig', [
            'message'    => 'Votre article a bien été mis à jour',
            'categories' => $categories,
            'article'    => $newArticle,
        ]);
    }
}
