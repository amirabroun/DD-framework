<?php

namespace App\Helpers;

class ReflectionHelper
{

    /**
     * @var array $paramFunction
     */
    private $paramFunction = [];

    /**
     * @var array $types
     */
    private array $types = [];

    /**
     * Types of param function
     * 
     * @param string|closure $function
     * @param string $controller
     * @return $this
     */
    public static function findParamFunctionTypes($function, $controller = null)
    {
        $instance = new static;

        if ($controller) {
            $method = new \ReflectionMethod($controller, $function);
        } else {
            $method = new \ReflectionFunction($function);
        }

        $parameters = $method->getParameters();

        if (isEmpty($parameters)) {
            return $instance;
        }

        foreach ($parameters as $parameter) {
            $instance->types[] = (string)$parameter->getType();
        }

        return $instance;
    }

    public function setRequestIfExist()
    {
        if (!isEmpty($this->types)) {
            if (str_contains($this->types[0], 'App\\Requests\\')) {
                $request = $this->types[0];

                $this->paramFunction[] = new $request;

                array_shift($this->types);
            }
        }

        return $this;
    }

    public function setParamFunction($data)
    {
        foreach ($data as $key => $value) {
            if (!isEmpty($this->types[$key])) {
                $type = $this->types[$key];

                settype($value, $type);
            }

            $this->paramFunction[] = $value;
        }

        return $this;
    }

    public function getParamFunction()
    {
        return $this->paramFunction;
    }

    public static function getDynamicObjectProperties(object $object)
    {
        $reflection = new \ReflectionObject($object);

        $properties = $reflection->getProperties();
        $defaultProperties = array_keys($reflection->getDefaultProperties());

        $vars = [];
        foreach ($properties as $property) {
            if (!in_array($property->getName(), $defaultProperties)) {
                $vars[$property->getName()] = $object->{$property->getName()};
            }
        }

        return $vars;
    }
}
