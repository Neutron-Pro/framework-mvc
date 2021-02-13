<?php

namespace NeutronStars\Controller;

use NeutronStars\HTTPCode;
use NeutronStars\Kernel;
use NeutronStars\View\Blade\BladeOne;
use NeutronStars\View\ViewEngine;

abstract class Controller
{
    protected function renderBlade(string $view, array $params = []): void
    {
        $blade = new BladeOne([VIEWS, LAYOUTS], BLADE_CACHE);
        $blade->directive('router', function (string $query): string {
            return '<?= $this->getRoute('.$query.') ?>';
        });
        echo $blade->run($view, $params);
        die;
    }

    protected function renderPHP(string $view, array $params = [], string $layout = 'index'): void
    {
        $params['router'] = Kernel::get()->getRouter();
        ob_start();
        extract($params);
        require VIEWS . '/' . str_replace('.', '/', $view) . '.php';
        $view = ob_get_clean();
        require LAYOUTS . '/' . str_replace('.', '/', $layout) . '.php';
        die;
    }

    protected function render(string $view, array $params = [], string $layout = 'index'): void
    {
        if (VIEW_ENGINE === ViewEngine::BLADE) {
            $this->renderBlade($view, $params);
        } else {
            $this->renderPHP($view, $params, $layout);
        }
    }

    protected function setCode(string $code)
    {
        header('HTTP/1.0 ' . $code);
    }

    protected function page404()
    {
        $this->setCode(HTTPCode::CODE_404);
        $this->render('app.404');
        die;
    }

    protected function redirect(string $route, $params = [])
    {
        header('Location: ' . Kernel::get()->getRouter()->get($route, $params));
        die;
    }
}
