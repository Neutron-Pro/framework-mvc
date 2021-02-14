<?php
namespace App\Controller;

use App\Model\UserModel;
use NeutronStars\Controller\Controller;
use NeutronStars\Service\Form\FormBuilder;
use NeutronStars\Service\Form\FormValidator;

class AuthController extends Controller
{
    public function index()
    {
        $this->page404();
    }

    public function login()
    {
        $validator = new FormValidator($_POST, [
            'email'    => ['type' => 'email'],
            'password' => ['min' => 8, 'max' => 32]
        ]);
        if ($validator->isSubmit() && $validator->isValid()) {
            $model = new UserModel();
            $user = $model->findById($validator->getValues()['email'], 'email');
            if ($user !== null && password_verify($validator->getValues()['password'], $user->password)) {
                if ($user->token_verify === null) {
                    $this->connectUser($user->id);
                    $this->redirect('home');
                }
                $error = 'Votre compte n\'a pas encore été vérifié. Vérifier votre boite mail.';
            } else {
                $error = 'Les identifiants ne sont pas valide !';
            }
        }
        $form = new FormBuilder($validator->getValues(), $validator->getErrors());
        if (!empty($error)) {
            $form->addAlert($error);
        }
        $this->render('app.auth.login', [
            'form' => $form
        ]);
    }

    public function logout()
    {
        $this->disconnectUser();
        $this->redirect('home');
    }

    public function register()
    {
        $validator = new FormValidator($_POST, [
            'name'     => [ 'min' => 3, 'max' => 30 ],
            'email'    => [ 'type' => 'email' ],
            'password' => [ 'min' => 8, 'max' => 32, 'add' => [ 'confirm_password' ] ]
        ]);
        if ($validator->isSubmit() && $validator->isValid()) {
            $values = $validator->getValues();
            if ($values['password'] !== $values['confirm_password']) {
                $validator->addError('password', 'Les mots de passe ne sont pas identiques.');
                $validator->addError('confirm_password', 'Les mots de passe ne sont pas identiques.');
            } else {
                $model = new UserModel();
                if ($model->findById($values['email'], 'email') !== null) {
                    $validator->addError('email', 'Cet email est déjà utilisé !');
                } else {
                    $token = md5(uniqid().mt_rand());
                    $id = $model->insert($values['name'], $values['email'], password_hash($values['password'], PASSWORD_ARGON2ID, [
                        'cost' => 12
                    ]), $token);
                    $this->createEmail()
                        ->add($values['email'], $values['name'])
                        ->send('Confirmation du compte', 'mail.auth.register', [
                            'id'    => $id,
                            'token' => $token,
                            'name'  => $values['name']
                        ]);
                    $validator->clearValues();
                    $success = 'Un email vous a été envoyé pour valider votre demande d\'inscription.';
                }
            }
        }
        $form = new FormBuilder($validator->getValues(), $validator->getErrors());

        if (!empty($success)) {
            $form->addAlert($success, true);
        }

        $this->render('app.auth.register', [
            'form' => $form
        ]);
    }

    public function confirm($id, $token): void
    {
        $model = new UserModel();
        $user = $model->getUserByToken($id, $token, 'token_verify');
        if ($user === null) {
            $this->page404();
        }
        $model->updateToken($id, null, 'token_verify');
        $this->redirect('auth.login');
    }
}
