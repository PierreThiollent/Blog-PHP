<?php

namespace App\Config;

class Routes
{
    /**
     * Return all routes for the application.
     */
    public static function getRoutes(): array
    {
        return [
            'home' => [
                'GET' => [
                    'path'       => '/',
                    'controller' => 'HomeController',
                    'method'     => 'index',
                ],
            ],

            'show_articles' => [
                'GET' => [
                    'path'       => '/articles',
                    'controller' => 'ArticlesController',
                    'method'     => 'index',
                ],
            ],

            'show_article' => [
                'GET' => [
                    'path'       => '/article/:id/:slug',
                    'controller' => 'ArticlesController',
                    'method'     => 'show',
                ],
            ],

            'register' => [
                'GET' => [
                    'path'       => '/inscription',
                    'controller' => 'SecurityController',
                    'method'     => 'register',
                ],
                'POST' => [
                    'path'       => '/inscription',
                    'controller' => 'SecurityController',
                    'method'     => 'register',
                ],
            ],

            'login' => [
                'GET' => [
                    'path'       => '/connexion',
                    'controller' => 'SecurityController',
                    'method'     => 'login',
                ],
                'POST' => [
                    'path'       => '/connexion',
                    'controller' => 'SecurityController',
                    'method'     => 'login',
                ],
            ],

            'dashboard' => [
                'GET' => [
                    'path'       => '/mon-compte',
                    'controller' => 'DashboardController',
                    'method'     => 'index',
                ],
                'POST' => [
                    'path'       => '/mon-compte',
                    'controller' => 'DashboardController',
                    'method'     => 'index',
                ],
            ],

            'logout' => [
                'GET' => [
                    'path'       => '/deconnexion',
                    'controller' => 'SecurityController',
                    'method'     => 'logout',
                ],
            ],

            'confirm-account' => [
                'GET' => [
                    'path'       => '/confirmer-compte/:id-:token',
                    'controller' => 'SecurityController',
                    'method'     => 'confirmAccount',
                ],
            ],

            'add-comment' => [
                'POST' => [
                    'path'       => '/add-comment',
                    'controller' => 'CommentsController',
                    'method'     => 'new',
                ],
            ],

            'add-article' => [
                'GET' => [
                    'path'       => '/admin/new-article',
                    'controller' => 'ArticlesController',
                    'method'     => 'new',
                ],
                'POST' => [
                    'path'       => '/admin/new-article',
                    'controller' => 'ArticlesController',
                    'method'     => 'new',
                ],
            ],

            'manage-articles' => [
                'GET' => [
                    'path'       => '/admin/list-articles',
                    'controller' => 'ArticlesController',
                    'method'     => 'manageArticles',
                ],
            ],

            'delete-article' => [
                'POST' => [
                    'path'       => '/admin/delete-article',
                    'controller' => 'ArticlesController',
                    'method'     => 'delete',
                ],
            ],

            'update-article' => [
                'GET' => [
                    'path'       => '/admin/update-article-:id',
                    'controller' => 'ArticlesController',
                    'method'     => 'update',
                ],
                'POST' => [
                    'path'       => '/admin/update-article-:id',
                    'controller' => 'ArticlesController',
                    'method'     => 'update',
                ],
            ],

            'contact' => [
                'GET' => [
                    'path'       => '/contact',
                    'controller' => 'ContactController',
                    'method'     => 'index',
                ],
                'POST' => [
                    'path'       => '/contact',
                    'controller' => 'ContactController',
                    'method'     => 'index',
                ],
            ],

            'manage-comments' => [
                'GET' => [
                    'path'       => '/admin/list-comments',
                    'controller' => 'CommentsController',
                    'method'     => 'manageComments',
                ],
            ],

            'validate-comment' => [
                'GET' => [
                    'path'       => '/admin/validate-comment-:id',
                    'controller' => 'CommentsController',
                    'method'     => 'validate',
                ],
            ],

            'delete-comment' => [
                'GET' => [
                    'path'       => '/admin/delete-comment-:id',
                    'controller' => 'CommentsController',
                    'method'     => 'delete',
                ],
            ],
        ];
    }
}
