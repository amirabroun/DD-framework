<?php

namespace App\Helpers;

use ReflectionFunction;
use ReflectionMethod;

class ReflectionHelper
{

    public static function findParamFunctionTypes($function, $controller = null)
    {
        if ($controller) {
            $method = new ReflectionMethod($controller, $function);
        } else {
            $method = new ReflectionFunction($function);
        }

        $parameters = $method->getParameters();

        if (isEmpty($parameters)) {
            return null;
        }

        $types = [];
        foreach ($parameters as $parameter) {
            $types[] = (string)$parameter->getType();
        }

        return $types;
    }
}
