<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Hydrator;
use App\Repository\CommentRepository;
use App\Validator\Validator;
use Twig\Environment;

class CommentsController extends AbstractController
{
    private Validator $validator;
    private Hydrator $hydrator;
    private CommentRepository $repository;

    public function __construct(Environment $twig)
    {
        $this->validator = new Validator();
        $this->hydrator = new Hydrator();
        $this->repository = new CommentRepository();
        parent::__construct($twig);
    }

    /**
     * Add comment.
     *
     * @method POST ajax
     */
    public function new()
    {
        if (empty($_POST)) {
            return;
        }

        $comment = new Comment();
        $errors = $this->validator->validate($comment, $_POST);

        if (!empty($errors)) {
            foreach ($errors as $error) { ?>
                <p style="color: red; margin-top: 20px;"><?php echo $error; ?></p>
            <?php }
            exit;
        }

        $this->hydrator->hydrate($comment, $_POST);
        $comment->setAuthor($_SESSION['user']);

        if (!$this->repository->add($comment)) {
            return $this->render('error.html.twig', ['error' => "Une erreur s'est produite pendant l'ajout de votre commentaire, veuillez réessayer."]);
        }

        return $this->render('message.html.twig', ['message' => 'Votre commentaire a bien été ajouté, il est en attente de validation.']);
    }
}
