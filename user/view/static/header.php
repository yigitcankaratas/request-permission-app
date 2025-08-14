<!doctype html>
<html lang="en">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <meta charset="UTF-8">
    <title><?= setting('title') ?></title>

    <!--styles-->
    <link rel="stylesheet" href="<?= public_url('styles/main.css') ?>">

    <!--scripts-->
    <script src="<?= public_url('scripts/jquery-1.12.2.min.js') ?>"></script>
    <!-- <script src="https://cdn.ckeditor.com/4.5.7/basic/ckeditor.js"></script>-->
    <script src="<?= public_url('scripts/admin.js') ?>"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</head>
<body>
<?php
if (is_string(end($_SESSION))) {
    try {
        $db = new PDO('mysql:host=localhost;dbname=meritdesk', 'root', '');

    } catch (PDOException $e) {
        die($e->getMessage());
    }
    $query3 = $db->prepare("SELECT user_role FROM users WHERE email = :eposta");
    $query3->execute([
        'eposta' => end($_SESSION)
    ]);
    $row3 = $query3->fetch(PDO::FETCH_ASSOC);
    if ($row3['user_role'] != 3) {
        echo 'Bu sayfaya erişim yetkiniz bulunmamaktadır';
        exit();
    }
} else {
    header('Location: /meritdesk/');
    //echo 'Lütfen önce giriş ekranından giriş yapınız';
    exit();
}
?>
<!--navbar-->
<div class="navbar">
    <ul dropdown>
        <li>
            <a href="index">
                <img src="/meritdesk/public/images/logo5.png" width="48px" height="48px" alt="">
                <span class="title">
                    MeritDesk
                </span>
            </a>
        </li>
    </ul>

    <form align="right" name="form_logout" method="post" action="/meritdesk/app/controller/logout.php">
        <label class="logoutLblPos">
            <button type="submit" name="logout" value="1" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-log-out">Çıkış Yap
            </button>
        </label>
    </form>

</div>

<!--sidebar-->
<div class="sidebar">

    <ul>
        <?php foreach ($user_menus as $mainUrl => $menu): ?>
            <li class="<?= (route(1) == $mainUrl) || isset($menu['submenu'][route(1)]) ? 'active' : null ?>">
                <a href="<?= user_url($mainUrl) ?>">
                    <span class="fa fa-<?= $menu['icon'] ?>"></span>
                    <span class="title">
                    <?= $menu['title'] ?>
                </span>
                </a>
                <?php if (isset($menu['submenu'])): ?>
                    <ul class="sub-menu">
                        <?php foreach ($menu['submenu'] as $url => $title): ?>

                            <li class="<?= (route(1) == $url) || isset($menu['submenu'][route(2)]) ? 'active' : null ?>">

                                <a href="<?= user_url($url) ?>">
                                    <?= $title ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>

        <li class="line">
            <span></span>
        </li>
    </ul>
    <a href="#" class="collapse-menu">
        <span class="fa fa-arrow-circle-left"></span>
        <span class="title">
Menüyü Küçült
</span>
    </a>

</div>

<!--content-->
<div class="content">
