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
        $validator = new FormValidator($_POST, [
            'email'   => ['type' => 'email'],
            'name'    => ['min' => 3, 'max' => 30],
            'message' => ['min' => 10]
        ]);

        if ($validator->isSubmit() && $validator->isValid()) {
            $send = true;
            try {
                $values = $validator->getValues();
                $this->createEmail()
                    ->add($values['email'], $values['name'])
                    ->send('Test de mail', 'mail.index', [
                        'name'    => $values['name'],
                        'email'   => $values['email'],
                        'message' => $values['message']
                    ]);
                $success = true;
                $validator->clearValues();
            } catch (Exception $e) {
            }
        }

        $this->render('app.contact', [
            'form'    => new FormBuilder($validator->getValues(), $validator->getErrors()),
            'send'    => $send ?? false,
            'success' => $success ?? false
        ]);
    }
}
