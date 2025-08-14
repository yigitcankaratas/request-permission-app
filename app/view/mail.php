<!doctype html>
<html lang="en">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <meta charset="UTF-8">

    <!--styles-->
    <link rel="stylesheet" href="<?= public_url('styles/main.css') ?>">
    <!--scripts-->
    <script src="<?= public_url('scripts/jquery-1.12.2.min.js') ?>"></script>
    <!-- <script src="https://cdn.ckeditor.com/4.5.7/basic/ckeditor.js"></script>-->
    <script src="<?= public_url('scripts/admin.js') ?>"></script>

</head>
<body>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


<!--content-->
<div class="content">

    <body>

    <!--login screen-->
    <div class="login-screen">

        <!--login logo-->
        <div class="login-logo">

            <img src='/meritdesk/public/images/logo3.png' alt="">
        </div>
        <?php if (isset($error)): ?>
            <div class="message error box-">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="message success box-">
                <?= $success ?>
            </div>
        <?php endif; ?>
<form action="mail" method="post" enctype="multipart/form-data">
    <input name="email" type="text" placeholder="E-posta adresi"/> <br><br>
    <button type="submit" class="btn btn-primary">Yeni Şifre Al</button>
</form>

</body>
</div>
</body>
</html>