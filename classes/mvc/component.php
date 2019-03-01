<?php

class component
{

    private static $controller;

    private static function setController($component)
    {


        //controller
        if (file_exists('components/' . $component)) {
            include "components/$component/controller.php";
            $controller = $component . 'controller';
            if (class_exists($controller)) {
                self::$controller = new $controller;
            }
        }
    }

    public static function includeComponent($component)
    {
        require_once 'controllerBase.php';
        require_once 'modelBase.php';
        require_once 'viewBase.php';

        self::setController($component);
        if (!empty(self::$controller)) {
            //if isset model
            if (file_exists('components/' . $component . '/model.php')) {
                include "components/$component/model.php";
            }
            //if isset view
            if (file_exists('components/' . $component . '/view.php')) {
                include "components/$component/view.php";
            }
            if (method_exists(self::$controller,'defaultAction')) {
                self::$controller->defaultAction();
            }

        } else {
            //TODO Exception
        }
    }
}