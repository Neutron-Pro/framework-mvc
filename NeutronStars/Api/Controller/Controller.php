<?php
namespace NeutronStars\Api\Controller;

use NeutronStars\Api\HTTPCode;
use NeutronStars\Core\Kernel;

abstract class Controller
{
    public function render(string $view, array $params = [], string $layout = 'index'): void
    {
        $router = Kernel::get()->getRouter();
        ob_start();
        extract($params);
        require VIEWS . '/' . str_replace('.', '/', $view).'.php';
        $view = ob_get_clean();
        require LAYOUTS . '/' . str_replace('.', '/', $layout) . '.php';
        die;
    }

    public function setCode(string $code)
    {
        header('HTTP/1.0 '.$code);
    }

    public function page404()
    {
        $this->setCode(HTTPCode::CODE_404);
        $this->render('app.404');
        die;
    }
}
