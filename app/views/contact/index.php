<?php require_once 'public/blocks/header.php' ?>

<div class="container">
    <div class="main">
        <div class="form-head">
            <h1>Обратная связь</h1>
            <p>Напишите нам, если у вас есть вопросы</p>
        </div>
        <form action="/contact" method="POST" class="form-control">
            <input type="text" name="name" placeholder="Введите имя" value="<?=$_POST['name']?>"><br>
            <input type="email" name="email" placeholder="Введите email" value="<?=$_POST['email']?>"><br>
            <input type="text" name="age" placeholder="Введите возраст" value="<?=$_POST['age']?>"><br>
            <textarea name="message" placeholder="Введите сообщение"><?=$_POST['message']?></textarea>
            <div class="error">
                <?=$data['message']?>
            </div>
            <button type="submit" class="btn" id="send">Отправить</button>
        </form>
    </div>
</div>

<?php require_once 'public/blocks/footer.php' ?>