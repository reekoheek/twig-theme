<?php

namespace ROH\Theme\TwigTheme;

use Twig_Environment as Environment;

class View extends \Slim\View
{
    protected $environment;

    protected $options = array(
        'cache' => '../twigCache',
        'viewPaths' => '../templates',
        'extension' => '.twig.php',
    );

    public function __construct(array $options = array())
    {
        parent::__construct();

        $this->options = array_merge($this->options, $options);

        if (!empty($this->options['overwrite'])) {
            $this->options['auto_reload'] = true;
        }
    }

    public function render($template)
    {
        return $this->getEnvironment()->render($template, $this->all());
    }

    public function getEnvironment()
    {
        if (is_null($this->environment)) {
            $loader = new Filesystem($this->options['viewPaths'], $this->options['extension']);
            $this->environment = new Environment($loader, $this->options);
        }

        return $this->environment;
    }
}
