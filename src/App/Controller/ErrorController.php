<?php

namespace App\Controller;

use NeutronStars\Controller\Controller;

class ErrorController extends Controller
{
    public function call404(): void
    {
        $this->page404();
    }
}
