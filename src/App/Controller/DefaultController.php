<?php

namespace App\Controller;

use NeutronStars\Controller\Controller;
use NeutronStars\Service\Form\FormBuilder;
use NeutronStars\Service\Form\FormValidator;
use NeutronStars\Service\PHPMailer\Exception;

class DefaultController extends Controller
{
    public function home()
    {
        $this->render('app.home');
    }

    public function contact()
    {
        $values = [];
        $errors = [];
        $send = false;
        $success = false;
        if (!empty($_POST)) {
            $validator = new FormValidator($_POST, [
               'email'   => ['type' => 'email'],
               'name'    => ['min' => 3, 'max' => 30],
               'message' => ['min' => 10]
            ]);
            $values = $validator->getValues();
            $errors = $validator->getErrors();
            if ($validator->isValid()) {
                $send = true;
                try {
                    $this->createEmail()
                        ->add($values['email'], $values['name'])
                        ->send('Test de mail', 'mail.index', [
                            'name'    => $values['name'],
                            'email'   => $values['email'],
                            'message' => $values['message']
                        ]);
                    $success = true;
                    $values = [];
                } catch (Exception $e) {}
            }
        }

        $this->render('app.contact', [
            'form'    => new FormBuilder($values, $errors),
            'send'    => $send,
            'success' => $success
        ]);
    }
}
