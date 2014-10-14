<?php

namespace ROH\Theme;

use Bono\Theme\Theme;
use ROH\Theme\TwigTheme\View as TwigView;

class TwigTheme extends Theme
{
    protected $extension = '.twig.php';

    protected $viewPaths;

    protected $view;

    public function __construct(array $options = array())
    {
        $this->options['auto_reload'] = !empty($this->options['overwrite']) ? $this->options['overwrite'] : false;

        parent::__construct($options);
    }

    public function getView()
    {
        if (is_null($this->view)) {
            $options = array_merge(array(
                'viewPaths' => $this->getViewPaths(),
                'extension' => $this->extension,
                ), $this->options);
            $this->view = new TwigView($options);
        }

        return $this->view;
    }

    protected function getViewPaths()
    {
        if (is_null($this->viewPaths)) {
            $flattenedArray = array();

            array_walk_recursive($this->baseDirectories, function ($x) use (&$flattenedArray) {
                $flattenedArray[] = $x.'/templates';
            });
            $this->viewPaths = $flattenedArray;
        }

        return $this->viewPaths;
    }
}
