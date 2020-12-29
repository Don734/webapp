<?php session_start(); ?>

<div class="user__settings">
    <a class="user__dropdown-toggle" id="user__menu-btn" href="#"><img class="user__avatar" src="../assets/img/favicon.ico"><span class="icon material-icons">expand_more</span></a>
    <ul class="user__setting-menu" id="user__menu">
        <div class="user__info-block">
            <div class="user__img-block"><img class="user__avatar" src="../assets/img/favicon.ico"></div>
            <p class="user__info-name"><?= $_SESSION['user']['fullname'] ?></p>
            <p class="user__info-pos"><?= $_SESSION['user']['position'] ?></p>
            <?php if($_SESSION['status']) {
                echo '<p class="user__info-status">' . $_SESSION['status'] . '</p>';
            } ?>
            <a class="user__info-settings" href="../pages/account.php">Управление аккаунтом</a>
        </div>
        <li class="user__item"><a class="user__link" href="../../../app/logout.php">Выход</a></li>
    </ul>
</div>