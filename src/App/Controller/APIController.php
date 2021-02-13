<?php
namespace App\Controller;

use NeutronStars\Controller\Controller;

class APIController extends Controller
{
    public function index(): void
    {
        $this->page404();
    }

    public function readme(): void
    {
        $this->renderText(file_get_contents(__DIR__.'/../../../README.MD'));
    }
}
