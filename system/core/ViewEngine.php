<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CI_ViewEngine
{
    /**
     * The path to the view file.
     *
     * @var string
     */
    protected $compiledsPath = APPPATH . 'cache/compileds/views/';

    /**
     * The array of view data.
     *
     * @var array
     */
    protected $data;

    /**
     * Array of opening and closing tags for raw echos.
     *
     * @var array
     */
    protected $rawTags = ['!{{', '}}'];

    /**
     * Array of ignore the tag.
     *
     * @var array
     */
    protected $ignoreTags = ['@{{', '}}'];

    /**
     * Array of opening and closing tags for regular echos.
     *
     * @var array
     */
    protected $echoTags = ['{{', '}}'];

    /**
     * Array the default PHP tags.
     *
     * @var string
     */
    protected $defaultTags = ['<?php echo', '?>'];



    protected function get_content_view_file($viewPath)
    {
        return file_get_contents($viewPath);
    }

    protected function put_content_view_file($viewPath)
    {
        //return file_put_contents($viewPath);
    }

    public function compiler($view, $path, $view_name)
    {
        copy($view, $this->compiledsPath . $view_name);

        $view = $this->get_content_view_file($this->compiledsPath . $view_name);
        $view = $this->view_filter($view);

        file_put_contents($this->compiledsPath . $view_name, $view);


        return $this->compiledsPath . $view_name;
    }

    protected function view_filter($view)
    {
        $view = str_ireplace($this->echoTags[0], $this->defaultTags[0], $view);
        $view = str_ireplace($this->echoTags[1], $this->defaultTags[1], $view);

        return $view;
    }

}
