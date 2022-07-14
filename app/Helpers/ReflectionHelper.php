<?php

namespace App\Helpers;

trait ReflectionHelper
{
    /**
     * Types of param function
     * 
     * @param string|closure $function
     * @param string $controller
     * @return array $types
     */
    protected static function findParamFunctionTypes($function, $controller = null)
    {
        if ($controller) {
            $method = new \ReflectionMethod($controller, $function);
        } else {
            $method = new \ReflectionFunction($function);
        }

        $parameters = $method->getParameters();

        if (isEmpty($parameters)) {
            return [];
        }

        $types = [];
        foreach ($parameters as $parameter) {
            $types[] = (string)$parameter->getType();
        }

        return $types;
    }

    /**
     * Get all dynamic object properties
     *
     * @param object $object
     * @return array $properties
     */
    protected static function getDynamicObjectProperties(object $object)
    {
        $reflection = new \ReflectionObject($object);

        $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);
        $defaultProperties = array_keys($reflection->getDefaultProperties());

        $dynamicProperties = [];
        foreach ($properties as $property) {
            if (!in_array($property->getName(), $defaultProperties)) {
                $dynamicProperties[$property->getName()] = $object->{$property->getName()};
            }
        }

        return $dynamicProperties;
    }
}
