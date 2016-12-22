<?php

namespace core;

class View
{
    private $working_folder;
    private $templates_root = 'app/templates/';
    private $layouts_folder;
    private $data = [];

    /**
     * View constructor.
     * @param $workingFolder string
     */

    public function __construct($working_folder, $layouts_folder)
    {
        $this->working_folder = $working_folder;
        $this->layouts_folder = $layouts_folder;
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
        if(isset($this->data[$name])){
            return $this->data[$name];
        }
    }

    /**
     * output generated page
     * @param $template string
     */

    public function render($template, $layout){
        $view_file = $this->templates_root.$this->working_folder."/".$template.".php";
        $layout_file = $this->templates_root.$this->layouts_folder."/".$layout.".php";

        extract($this->data);

        ob_start();
        require_once ($layout_file);
        if (file_exists($view_file)) {
            require_once($view_file);
        }
        $output = ob_get_clean();
        echo $output;
    }

}