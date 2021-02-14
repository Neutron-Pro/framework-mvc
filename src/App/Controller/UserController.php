<?php
namespace App\Controller;

use NeutronStars\Controller\Controller;

class UserController extends Controller
{
    public function profile(): void
    {
        $this->render('app.users.profile');
    }
}
