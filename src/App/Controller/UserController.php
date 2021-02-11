<?php
namespace App\Controller;
use App\Model\UserModel;
use NeutronStars\Controller\Controller;

class UserController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function users()
    {
        $this->render('app.users.users', [
            'users' => $this->userModel->all()
        ]);
    }

    public function user($id)
    {
        $user = $this->userModel->findById($id);
        if(empty($user)){
            $this->page404();
        }
        $this->render('app.users.user', [
            'user' => $user
        ]);
    }
}
