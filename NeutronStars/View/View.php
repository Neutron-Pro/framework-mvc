<?php

namespace NeutronStars\View;

use NeutronStars\Kernel;

use Exception;

class View
{
    private int $engine;
    private string $viewPath;
    private array $params;

    public function __construct(int $engine, string $viewPath, array $params)
    {
        $this->engine = $engine;
        $this->viewPath = $viewPath;
        $this->params = $params;
    }

    /**
     * @param ?string $layout
     * @return string
     * @throws Exception
     */
    public function run(?string $layout = null): string
    {
        switch ($this->engine) {
            case ViewEngine::BLADE:
                return $this->renderBlade();
            case ViewEngine::DEFAULT:
                return $this->renderDefault($layout);
        }
        throw new Exception('Can\'t found the view engine !');
    }

    /**
     * @return string
     * @throws Exception
     */
    private function renderBlade(): string
    {
        return Kernel::get()->getBlade()->run($this->viewPath, $this->params);
    }

    private function renderDefault(?string $layout = null): string
    {
        $this->params['router'] = Kernel::get()->getRouter();
        ob_start();
        extract($this->params);
        require VIEWS . '/' . str_replace('.', '/', $this->viewPath) . '.php';
        $view = ob_get_clean();
        if ($layout !== null) {
            ob_start();
            require LAYOUTS . '/' . str_replace('.', '/', $layout) . '.php';
            $view = ob_get_clean();
        }
        return $view;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function __toString(): string
    {
        return $this->run();
    }
}
