<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Http\Request;
use App\Http\Session;
use App\Hydrator;
use App\Repository\CommentRepository;
use App\Validator\Validator;
use Twig\Environment;

class CommentsController extends AbstractController
{
    private Validator $validator;
    private Hydrator $hydrator;
    private CommentRepository $repository;

    public function __construct(Environment $twig, Request $request, Session $session)
    {
        $this->validator = new Validator();
        $this->hydrator = new Hydrator();
        $this->repository = new CommentRepository();
        parent::__construct($twig, $request, $session);
    }

    /**
     * Add comment.
     *
     * @method POST ajax
     */
    public function new()
    {
        if (empty($this->request->getPostParams())) {
            return;
        }

        $comment = new Comment();
        $errors = $this->validator->validate($comment, $this->request->getPostParams());

        if (!empty($errors)) {
            foreach ($errors as $error) { ?>
                <p style="color: red; margin-top: 20px;"><?php echo $error; ?></p>
            <?php }
            exit;
        }

        $this->hydrator->hydrate($comment, $this->request->getPostParams());
        $comment->setAuthor($this->session->get('user'));

        if (!$this->repository->add($comment)) {
            return $this->render('error.html.twig', ['error' => "Une erreur s'est produite pendant l'ajout de votre commentaire, veuillez réessayer."]);
        }

        return $this->render('message.html.twig', ['message' => 'Votre commentaire a bien été ajouté, il est en attente de validation.']);
    }

    public function manageComments()
    {
        if (is_null($this->session->get('user')) || $this->session->get('user')->getRole() !== 'admin') {
            return $this->render('404.html.twig');
        }

        $comments = $this->repository->getAll(['publishedAt' => 'DESC']);

        return $this->render('admin/list_comments.html.twig', ['comments' => $comments]);
    }

    public function validate(int $id): bool
    {
        if (is_null($this->session->get('user')) || $this->session->get('user')->getRole() !== 'admin') {
            return $this->render('404.html.twig');
        }

        if (!$this->repository->validate($id)) {
            // TODO pass an error alert
            return $this->redirect('/admin/list-comments');
        }

        // TODO pass a confirmation alert
        return $this->redirect('/admin/list-comments');
    }

    public function delete(int $id): bool
    {
        if (is_null($this->session->get('user')) || $this->session->get('user')->getRole() !== 'admin') {
            return $this->render('404.html.twig');
        }

        if (!$this->repository->delete($id)) {
            // TODO pass an error alert
            return $this->redirect('/admin/list-comments');
        }

        // TODO pass a confirmation alert
        return $this->redirect('/admin/list-comments');
    }
}
