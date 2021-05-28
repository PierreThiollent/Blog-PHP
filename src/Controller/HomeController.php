<?php

namespace App\Controller;

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->render('index.html.twig');
    }
}
