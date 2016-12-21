<?php

namespace core;

class View
{
    private $workingFolder;
    private $templatesRoot = 'app/templates/';
    private $data = [];

    /**
     * View constructor.
     * @param $workingFolder string
     */

    public function __construct($workingFolder)
    {
        $this->workingFolder = $this->templatesRoot.$workingFolder.'/';
    }

    /**
     * @param $name string
     * @param $value string
     */

    public  function set($name, $value){
        $this->data[$name] = $value;
    }

    /**
     * @param $name string
     * @return mixed
     */

    public function get($name){
        return $this->data[$name];
    }

    /**
     * output generated page
     * @param $template string
     */

    public function render($template){
        $view_file = $this->workingFolder.$template.".php";

        extract($this->data);

        ob_start();
        if (file_exists($view_file)) {
            require_once($view_file);
        }
        $output = ob_get_contents();
        ob_end_clean();
        $output = $this->sanitize_output($output);
        echo $output;
    }

    /**
     * clean from whitespaces
     * @param $buffer
     * @return mixed
     */

    private function sanitize_output($buffer) {
        $search = array(
            '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
            '/[^\S ]+\</s',  // strip whitespaces before tags, except space
            '/(\s)+/s'       // shorten multiple whitespace sequences
        );
        $replace = array('>', '<', '\\1');
        $buffer = preg_replace($search, $replace, $buffer);
        return $buffer;
    }

}