<?php

namespace App\Controller;

use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use App\Repository\ArticlesRepository;
use Twig\Environment;

class HomeController extends AbstractController
{

    public function __construct(Environment $twig, Request $request, Session $session, File $files)
    {
        parent::__construct($twig, $request, $session, $files);
    }

    public function index(): string
    {
        $repository = new ArticlesRepository();

        $trendingArticles = $repository->getTrending(['updatedDate' => 'DESC'], 6);
        $latestArticles = $repository->getAll(['updatedDate' => 'DESC'], 6);
        $sportArticles = $repository->getArticlesByCategory(3, ['updatedDate' => 'DESC'], 3);
        $foodArticles = $repository->getArticlesByCategory(4, ['updatedDate' => 'DESC'], 3);

        return $this->render('index.html.twig', [
            'trendingArticles' => $trendingArticles,
            'latestsArticles'  => $latestArticles,
            'sportArticles'    => $sportArticles,
            'foodArticles'     => $foodArticles,
        ]);
    }
}
