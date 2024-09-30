<?php

class BaseController
{
    const VIEWS_PATH = "app/views/layouts/";
    const MODELS_PATH = "app/models/";

    public function view($pathView, $data = array())
    {
        $path = self::VIEWS_PATH . $pathView;
        return require_once $path;
    }

    public function load_model($modelName, $conn)
    {
        $path = self::MODELS_PATH . $modelName . ".php";
        if (file_exists($path)) {
            require_once $path;
            if (class_exists($modelName)) {
                return new $modelName($conn);
            }
        }
        return null;
    }
}
