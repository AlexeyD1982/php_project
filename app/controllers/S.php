<?php


class s extends Controller
{

    public function index($params)
    {
        if (count($params) > 0) {
            $links = $this->model('LinkModel');
            $link = $links->getUsersLink($_COOKIE['login'], $params);
            if ($link['fullLink'] != '') {
                header('Location: ' . $link['fullLink']);
            }
        }
    }

}