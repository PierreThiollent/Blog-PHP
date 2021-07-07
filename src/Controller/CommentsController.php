<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Hydrator;
use App\Validator\Validator;
use App\Repository\CommentRepository;

class CommentsController extends AbstractController
{
    private Validator $validator;
    private Hydrator $hydrator;
    private CommentRepository $repository;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->hydrator = new Hydrator();
        $this->repository = new CommentRepository();
    }

    /**
     * Add comment
     *
     * @route /add-comment
     * @method POST ajax
     * @return void
     */
    public function new()
    {
        if (!empty($_POST)) {
            $comment = new Comment();

            $errors = $this->validator->validate($comment, $_POST);

            if (!empty($errors)) {
                foreach ($errors as $error) : ?>
                    <p style="color: red;"><?= $error ?></p>
                <?php endforeach;
            }

            $this->hydrator->hydrate($comment, $_POST);
            $comment->setAuthor($_SESSION['user']);

            if (!$this->repository->add($comment)) {
                return $this->render('error.html.twig', ['error' => "Une erreur s'est produite pendant l'ajout de votre commentaire, veuillez réessayer."]);
            }
            
            return $this->render('message.html.twig', ['message' => "Votre commentaire a bien été ajouté, il est en attente de validation."]);
        }
    }
}
