<?php


class Controller
{
    protected function model($model)
    {
        require 'app/models/' . $model . '.php';
        return new $model();
    }

    protected function view($path, $data = [])
    {
        require_once 'app/views/' . $path . '.php';

    }
}