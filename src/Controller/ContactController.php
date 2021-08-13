<?php

namespace App\Controller;

use App\Http\File;
use App\Http\Request;
use App\Http\Session;
use Twig\Environment;

class ContactController extends AbstractController
{
    public function __construct(Environment $twig, Request $request, Session $session, File $files)
    {
        parent::__construct($twig, $request, $session, $files);
    }

    public function index(): string
    {
        if (empty($this->request->getParams('POST'))) {
            return $this->render('contact.html.twig');
        }

        foreach ($this->request->getParams('POST') as $key => &$value) {
            if ($value === '') {
                $errors[$key] = 'Le champ ne doit pas être vide.';
            }

            if ($key === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$key] = 'Vous devez renseigner un email valide';
            }

            // Sanitize data
            $value = htmlspecialchars($value);
        }

        if (!empty($errors)) {
            return $this->render('contact.html.twig', ['errors' => $errors]);
        }

        $nom = $this->request->getParam('POST', 'nom');
        $prenom = $this->request->getParam('POST', 'prenom');
        $email = $this->request->getParam('POST', 'email');
        $message = $this->request->getParam('POST', 'message');

        $mail = mail(
            'pierre.thiollent76@gmail.com',
            'Nouveau mail reçu depuis le formulaire de contact Superblog.',
            "Vous avez reçu un mail depuis le formulaire de contact.<br><br>Nom : $nom $prenom<br>Email : $email<br>Message : $message",
            implode("\r\n", ['From: contact@superblog.fr', 'Content-type: text/html; charset=utf-8'])
        );

        if (!$mail) {
            return $this->render('contact.html.twig', ['error' => "Une erreur s'est produite pendant l'envoi de votre mail, veuillez réessayer."]);
        }

        return $this->render('contact.html.twig', ['message' => 'Votre mail a bien été envoyé.']);
    }
}
