<?php
require_once 'DB.php';

class UserModel
{
    private $name;
    private $email;
    private $pass;

    private $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function setData($name, $email, $pass)
    {
        $this->name = $name;
        $this->email = $email;
        $this->pass = $pass;
    }

    public function isEmailBusy()
    {
        $result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$this->email'");
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if ($user['email'] == '') {
            return false;
        }
        return true;
    }

    public function validForm()
    {
        if (strlen($this->name) < 3) {
            return "Имя слишком короткое";
        } elseif (strlen($this->email) < 3) {
            return 'Email слишком короткий';
        } elseif (strlen($this->pass) < 3) {
            return 'Пароль меньше 3 символов';
        } elseif ($this->isEmailBusy()) {
            return 'Пользователь с таким email уже существует';
        }

        return 'Верно';
    }

    public function addUser()
    {
        $sql = 'INSERT INTO users (name, email, pass) VALUES (:name, :email, :pass)';
        $query = $this->_db->prepare($sql);
        $pass = password_hash($this->pass, PASSWORD_DEFAULT);
        $query->execute(['name' => $this->name, 'email' => $this->email, 'pass' => $pass]);
        $this->setAuth($this->email);
    }

    public function getUser()
    {
        $email = $_COOKIE['login'];
        $result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$email'");
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function logOut()
    {
        setcookie('login', $this->email, time() - 3600, '/');
        unset($_COOKIE['login']);
        header('Location: /user/auth');
    }

    public function auth($email, $pass)
    {
        $result = $this->_db->query("SELECT * FROM `users` WHERE `email` = '$email'");
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if ($user['email'] == '')
            return 'Пользователь с таким email не существует';
        elseif (password_verify($pass, $user['pass'])) {
            $this->setAuth($email);
        } else {
            return 'Пароль неверный';
        }
    }

    public function setAuth($email)
    {
        setcookie('login', $email, time() + 3600, '/');
        header('Location: /user');
    }

}