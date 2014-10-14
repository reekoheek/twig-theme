<?php

namespace ROH\Theme\TwigTheme;

class Filesystem extends \Twig_Loader_Filesystem
{
    protected $extension = '.twig.php';

    public function __construct($paths = array(), $extension = null)
    {
        parent::__construct($paths);

        if (is_null($extension)) {
            $this->extension = $extension;
        }
    }

    public function findTemplate($name)
    {
        try {
            return parent::findTemplate($name.$this->extension);
        } catch (\Exception $e) {
            return parent::findTemplate($name);
        }
    }
}
