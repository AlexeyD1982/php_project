<?php require_once 'public/blocks/header.php' ?>

<div class="container">
    <div class="main">
        <div class="form-head">
            <h1>Сокра.тим</h1>
            <?php
            $slogan = isset($_COOKIE['login']) ? 'Сейчас мы это сделаем' : 'Прежде, чем мы это сделаем, зарегистрируйтесь на сайте';
            ?>
            <span>Вам нужно сократить ссылку? <?= $slogan ?></span>
        </div>

        <?php if (isset($_COOKIE['login'])): ?>
            <form action="/home" method="POST" class="form-control">
                <input type="text" name="fullLink" placeholder="Длинная ссылка" value="<?= $_POST['fullLink'] ?>"><br>
                <input type="text" name="cutLink" placeholder="Короткое название" value="<?= $_POST['cutLink'] ?>"><br>
                <div class="error"><?= $data['message'] ?></div>
                <button type="submit" class="btn">Уменьшить</button>
            </form>
            <div class="links-control">
                <?php if (count($data['links']) > 0): ?>
                    <h2>Сокращенные ссылки</h2>
                    <?php foreach ($data['links'] as $link): ?>
                        <div class="links-item">
                            <p><b>Длинная: </b><?= $link['fullLink'] ?></p>
                            <p><b>Короткая: </b><a
                                        href="<?= ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') ?>://<?= $_SERVER['HTTP_HOST'] ?>/s/<?= $link['cutLink'] ?>" target="_blank"><?= $link['cutLink'] ?></a>
                            </p>
                            <form action="/home" method="post" class="form-control">
                                <input type="hidden" name="removeLink" value="<?= $link['id'] ?>">
                                <button type="submit" class="btn">Удалить <i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        <?php else: ?>
            <form action="/user/reg" method="POST" class="form-control">
                <input type="email" name="email" placeholder="Введите email" value="<?= $_POST['email'] ?>"><br>
                <input type="text" name="name" placeholder="Введите логин" value="<?= $_POST['name'] ?>"><br>
                <input type="password" name="pass" placeholder="Введите пароль" value="<?= $_POST['pass'] ?>"><br>
                <div class="error"><?= $data['message'] ?></div>
                <button type="submit" class="btn">Зарегистрироваться</button>
                <br><br>
                <span>Есть аккаунт? Тогда вы можете <a href="/user/auth" id="auth">авторизоваться</a></span>
            </form>
        <?php endif; ?>
    </div>

</div>

<?php require_once 'public/blocks/footer.php' ?>