<?php

namespace App\Controller;

class ContactController extends AbstractController
{
    public function index()
    {
        if (empty($_POST)) {
            return $this->render('contact.html.twig');
        }

        foreach ($_POST as $key => &$value) {
            if ($value === '') {
                $errors[$key] = 'Le champ ne doit pas être vide.';
            }

            if ($key === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$key] = 'Vous devez renseigner un email valide';
            }
        }

        if (!empty($errors)) {
            return $this->render('contact.html.twig', ['errors' => $errors]);
        }

        $mail = mail(
            'pierre.thiollent76@gmail.com',
            'Nouveau mail reçu depuis le formulaire de contact Superblog.',
            "Vous avez reçu un mail depuis le formulaire de contact.<br><br>Nom : {$_POST['nom']} {$_POST['prenom']}<br>Email : {$_POST['email']}<br>Message : {$_POST['message']}",
            implode("\r\n", ['From: contact@superblog.fr', 'Content-type: text/html; charset=utf-8'])
        );

        if (!$mail) {
            return $this->render('contact.html.twig', ['error' => "Une erreur s'est produite pendant l'envoi de votre mail, veuillez réessayer."]);
        }

        return $this->render('contact.html.twig', ['message' => 'Votre mail a bien été envoyé.']);
    }
}
