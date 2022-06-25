<?php

namespace App\Helpers;

class Requests
{
    public function __construct(private $action = null)
    {
    }

    public function route($route, array $with = [])
    {
        ($this->action)($route, $with);
    }

    public function resource($path, array $with = [])
    {
        ($this->action)('/resources' . '/' . preparePath($path), $with);
    }

    public function view($path, array $with = [])
    {
        ($this->action)('/resources/Views/' . preparePath($path), $with);
    }
}
