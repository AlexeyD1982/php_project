<?php require_once 'public/blocks/header.php' ?>

<div class="container">
    <div class="main">
        <div class="form-head">
            <h1>Авторизация</h1>
            <p>Здесь вы можете авторизоваться на сайте</p>
        </div>
        <form action="/user/auth" method="POST" class="form-control">
            <input type="email" name="email" placeholder="Введите email" value="<?= $_POST['email'] ?>"><br>
            <input type="password" name="pass" placeholder="Введите пароль" value="<?= $_POST['pass'] ?>"><br>
            <div class="error"><?= $data['message'] ?></div>
            <button type="submit" class="btn" id="send">Готово</button>
        </form>
    </div>

</div>

<?php require_once 'public/blocks/footer.php' ?>