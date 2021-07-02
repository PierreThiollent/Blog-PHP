<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;

class HomeController extends AbstractController
{
    private ArticlesRepository $repository;

    public function index()
    {
        $this->repository = new ArticlesRepository();

        $trendingArticles = $this->repository->getTrending(['updatedDate' => 'DESC'], 6);
        $latestArticles = $this->repository->getAll(['updatedDate' => 'DESC'], 6);
        $sportArticles = $this->repository->getArticlesByCategory(3, ['updatedDate' => 'DESC'], 3);
        $foodArticles = $this->repository->getArticlesByCategory(4, ['updatedDate' => 'DESC'], 3);

        return $this->render('index.html.twig', [
            'trendingArticles' => $trendingArticles,
            'latestsArticles' => $latestArticles,
            'sportArticles' => $sportArticles,
            'foodArticles' => $foodArticles,
        ]);
    }
}
