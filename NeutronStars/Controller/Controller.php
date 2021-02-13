<?php

namespace NeutronStars\Controller;

use NeutronStars\HTTPCode;
use NeutronStars\Kernel;
use NeutronStars\Service\PHPMailer\Email;
use NeutronStars\View\Blade\BladeOne;
use NeutronStars\View\View;
use NeutronStars\View\ViewEngine;

abstract class Controller
{
    protected function renderBlade(string $view, array $params = []): void
    {
        echo (new View(ViewEngine::BLADE, $view, $params));
    }

    protected function renderPHP(string $view, array $params = [], string $layout = 'index'): void
    {
        echo (new View(ViewEngine::DEFAULT, $view, $params))->run($layout);
    }

    protected function render(string $view, array $params = [], string $layout = 'index'): void
    {
        if (VIEW_ENGINE === ViewEngine::BLADE) {
            $this->renderBlade($view, $params);
        } else {
            $this->renderPHP($view, $params, $layout);
        }
    }

    protected function setCode(string $code): void
    {
        header('HTTP/1.0 ' . $code);
    }

    protected function page404(): void
    {
        $this->setCode(HTTPCode::CODE_404);
        $this->render('app.404');
        die;
    }

    protected function redirect(string $route, $params = []): void
    {
        header('Location: ' . Kernel::get()->getRouter()->get($route, $params));
        die;
    }

    public function createEmail(): Email
    {
        return new Email();
    }
}
