
<?php require_once 'public/blocks/header.php' ?>

<div class="container main">
    <h1>Регистрация</h1>
    <p>Здесь вы можете зарегистрироваться</p>
    <form action="/user/reg" method="POST" class="form-control">
        <input type="text" name="name" placeholder="Введите имя" value="<?=$_POST['name']?>"><br>
        <input type="email" name="email" placeholder="Введите email" value="<?=$_POST['email']?>"><br>
        <input type="password" name="pass" placeholder="Введите пароль" value="<?=$_POST['pass']?>"><br>
        <div class="error"><?=$data['message']?></div>
        <button type="submit" class="btn" id="send">Готово</button>
    </form>
</div>

<?php require_once 'public/blocks/footer.php' ?>