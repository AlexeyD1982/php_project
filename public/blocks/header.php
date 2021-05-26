<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php $data['title'] ?></title>
    <meta name="description" content="<?php $data['title'] ?>">
    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
    <link rel="stylesheet" href="/public/css/form.css" charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
          integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
<body>
<header>
    <div class="container top-menu">
        <div class="logo">
            <img src="/public/img/logo.svg" alt="Logo">
            <span>Уберем все лишнее из ссылки!</span>
        </div>
        <div class="nav">
            <a href="/">Главная</a>
            <a href="/contact/about">Про нас</a>
            <a href="/contact">Контакты</a>
            <?php if (isset($_COOKIE['login'])): ?>
                <a href="/user">Личный кабинет</a>
            <?php else: ?>
                <a href="/user/auth">Войти</a>
            <?php endif; ?>
        </div>
    </div>
</header>
