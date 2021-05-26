<?php


class Home extends Controller
{
    public function index()
    {
        $links = $this->model('LinkModel');
        $data = ['title' => 'Сократим'];
        if (isset($_POST['cutLink'])) {
            $links->setData($_POST['fullLink'], $_POST['cutLink']);

            $isValid = $links->validForm();
            if ($isValid === 'Верно') {
                $links->addLink();
            } else {
                $data['message'] = $isValid;
            }
        }

        if (isset($_POST['removeLink'])) {
            $links->removeLink($_POST['removeLink']);
        }

        $data['links'] =$links->getAllUsersLinks($_COOKIE['login']);
        $this->view('home/index', $data);
    }
}