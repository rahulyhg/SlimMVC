<?php

<?php

namespace MyApp\Core;

class Slim extends \Slim\Slim
{
    public function __construct(array $userSettings = array()) {
        parent::__construct($userSettings);

        $this->defineExtensionView();
        //$this->initDB($this->config('db'), $this);
    }

    /**
     * Execute Requested controller class
     * If it doesn't exist, do 404
     */
    public function fireController($params)
    {
        $name = array_shift($params);
        $name = (empty($name)) ? 'Index': ucfirst($name);
        $namespace = $this->config('controller.prefix');
        $classe = $namespace . $name . 'Controller';

        if (!class_exists($classe))
            $this->notFound();

        $controller = new $classe($this);
        $controller->setName($name);
        $controller->setDefaultModel();
        $controller->setUriParams($params);
        $controller->execute();
    }

    /**
     * Set up Twig Config
     */
    public function defineExtensionView()
    {
        $this->view->parserOptions = $this->config('templates.options');
        $this->view->parserExtensions = array(new \Slim\Views\TwigExtension());
    }
    
    public function initDB($config, $app)
    {
    
    }

}
