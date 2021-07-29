<?php

namespace App\Controller;

use App\Entity\Article;
use App\Helpers;
use App\Hydrator;
use App\Repository\ArticlesRepository;
use App\Repository\CategoryRepository;
use App\Validator\Validator;
use Twig\Environment;

class ArticlesController extends AbstractController
{
    private ArticlesRepository $repository;
    private Hydrator $hydrator;
    private Validator $validator;
    private Helpers $helpers;

    public function __construct(Environment $twig)
    {
        $this->repository = new ArticlesRepository();
        $this->hydrator = new Hydrator();
        $this->validator = new Validator();
        $this->helpers = new Helpers();
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

        if (!$article) {
            return $this->render('404.html.twig');
        }

        return $this->render('article_detail.html.twig', ['article' => $article]);
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

        $_POST['author'] = $_SESSION['user'];
        isset($_POST['trending']) ? $_POST['trending'] = (int) $_POST['trending'] : $_POST['trending'] = 0;

        $errors = $this->validator->validate($article, $_POST);

        if (!isset($errors['category'])) {
            $_POST['category'] = $categoryRepo->getById((int) $_POST['category']);
        }

        if ($_FILES['thumbnailUrl']['size'] <= 0) {
            $errors['thumbnailUrl'] = 'Vous devez renseigner une image mise en avant';
        } elseif (!in_array($_FILES['thumbnailUrl']['type'], ['image/jpeg', 'image/png'])) {
            $errors['thumbnailUrl'] = "L'image importée n'est pas valide. Extensions acceptées : .png, .jpg et .jpeg";
        }

        if (!empty($errors)) {
            return $this->render('admin/new_article.html.twig', ['errors' => $errors, 'post' => $_POST, 'categories' => $categories]);
        }

        $thumbnailName = time() . '-' . $_FILES['thumbnailUrl']['name'];
        move_uploaded_file($_FILES['thumbnailUrl']['tmp_name'], __DIR__ . "/../../public/images/$thumbnailName");

        $this->hydrator->hydrate($article, $_POST);

        $article->setSlug($this->helpers->slugify($article->getTitle()));
        $article->setThumbnailUrl("/images/$thumbnailName");

        if (!$this->repository->add($article)) {
            return $this->render('admin/new_article.html.twig', [
                'error'      => "Une erreur s'est produite pendant la publication de l'article, veuillez réessayer.",
                'categories' => $categories,
            ]);
        }

        return $this->render('admin/new_article.html.twig', ['message' => 'Votre article a bien été publié', 'categories' => $categories]);
    }

    public function manageArticles()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== 'admin') {
            return $this->render('404.html.twig');
        }

        $articles = $this->repository->getAll(['updatedDate' => 'DESC']);

        return $this->render('admin/list_articles.html.twig', ['articles' => $articles]);
    }

    public function deleteArticle()
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

        unlink(realpath(__DIR__ . '/../..') . "/public{$_POST['thumbnailUrl']}");

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

        $_POST['author'] = $_SESSION['user'];
        isset($_POST['trending']) ? $_POST['trending'] = (int) $_POST['trending'] : $_POST['trending'] = 0;

        $errors = $this->validator->validate($newArticle, $_POST);

        if (!isset($errors['category'])) {
            $_POST['category'] = $categoryRepo->getById((int) $_POST['category']);
        }

        if (isset($_FILES['thumbnailUrl']['size']) && $_FILES['thumbnailUrl']['size'] > 0) {
            if (!in_array($_FILES['thumbnailUrl']['type'], ['image/jpeg', 'image/png'])) {
                $errors['thumbnailUrl'] = "L'image importée n'est pas valide. Extensions acceptées : .png, .jpg et .jpeg";
            }
        }

        if (!empty($errors)) {
            return $this->render('admin/update_article.html.twig', ['errors' => $errors, 'article' => $_POST, 'categories' => $categories]);
        }

        if (isset($_FILES['thumbnailUrl']['size']) && $_FILES['thumbnailUrl']['size'] > 0) {
            // Supprimer l'ancienne image
            unlink(realpath(__DIR__ . '/../../public') . $article->getThumbnailUrl());

            $thumbnailName = time() . '-' . $_FILES['thumbnailUrl']['name'];
            move_uploaded_file($_FILES['thumbnailUrl']['tmp_name'], __DIR__ . "/../../public/images/$thumbnailName");

            $newArticle->setThumbnailUrl("/images/$thumbnailName");
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

        return $this->render('admin/update_article.html.twig', ['message' => 'Votre article a bien été mis à jour', 'categories' => $categories, 'article' => $newArticle]);
    }
}
