<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoryRepository;

class ArticlesController extends AbstractController
{
    private ArticlesRepository $repository;
    private CategoryRepository $categoryRepository;

    public function __construct()
    {
        $this->repository = new ArticlesRepository();
        $this->categoryRepository = new CategoryRepository();
    }

    public function index()
    {
        $articles = $this->repository->getAll(['updatedDate' => 'DESC']);

        foreach ($articles as $article) {
            $category = $this->categoryRepository->getById($article->getCategoryId());
            $categories[] = $category;
        }

        return $this->render('articles.html.twig', ['articles' => $articles, 'categories' => $categories]);
    }
}
