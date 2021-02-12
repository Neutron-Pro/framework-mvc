<?php

namespace App\Controller;

use NeutronStars\Controller\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $this->render('app.home');
    }
}
