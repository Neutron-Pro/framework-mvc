<?php
namespace App\Controller;
use NeutronStars\Api\Controller\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $this->render('app.home');
    }
}
