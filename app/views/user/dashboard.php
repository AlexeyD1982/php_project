<?php require_once 'public/blocks/header.php' ?>

<div class="container">
    <h1>Кабинет пользователя</h1>
    <div class="user-info">
        <p>Привет, <b><?= $data['user']['name'] ?></b></p>
        <form action="/user" method="post">
            <input type="hidden" name="exit_btn">
            <button type="submit" class="btn">Выйти</button>
        </form>
    </div>
</div>

<?php require_once 'public/blocks/footer.php' ?>