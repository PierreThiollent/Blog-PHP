<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;

class ArticlesController extends AbstractController
{
    private ArticlesRepository $repository;

    public function __construct()
    {
        $this->repository = new ArticlesRepository();
    }

    public function index()
    {
        $articles = $this->repository->getAll();

        return $this->render('articles.html.twig', ['articles' => $articles]);
    }
}
