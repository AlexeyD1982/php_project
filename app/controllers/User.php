<?php

class User extends Controller
{
    public function reg()
    {

        $data = ['title' => 'Регистрация'];
        if (isset($_POST['name'])) {
            $user = $this->model('UserModel');
            $user->setData($_POST['name'], $_POST['email'], $_POST['pass'], $_POST['re_pass']);

            $isValid = $user->validForm();
            if ($isValid === 'Верно') {
                $user->addUser();
            } else {
                $data['message'] = $isValid;
            }
        }
        $this->view('user/reg', $data);
    }
    public function index()
    {
        $errors = '';
        $user = $this->model('UserModel');
        if (isset($_POST['exit_btn'])) {
            $user->logOut();
            exit();
        }
        $data = ['error' => $errors, 'user' => $user->getUser(), 'title' => 'Личный кабинет'];
        $this->view('user/dashboard', $data);
    }

    public function auth()
    {
        $data = ['title' => 'Авторизация'];
        if (isset($_POST['email'])) {
            $user = $this->model('UserModel');
            $data['message'] = $user->auth($_POST['email'], $_POST['pass']);

        }
        $this->view('user/auth', $data);
    }
}