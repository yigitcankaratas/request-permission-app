<!doctype html>
<html lang="en">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title><?= setting('title') ?></title>
    <meta charset="UTF-8">

    <!--styles-->
    <link rel="stylesheet" href="<?= public_url('styles/main.css') ?>">
    <!--scripts-->
    <script src="<?= public_url('scripts/jquery-1.12.2.min.js') ?>"></script>
    <!-- <script src="https://cdn.ckeditor.com/4.5.7/basic/ckeditor.js"></script>-->
    <script src="<?= public_url('scripts/admin.js') ?>"></script>

    <script>
        var onloadCallback = function() {
            grecaptcha.render('guvenlik1', {
                'sitekey' : '6Lc6uKUrAAAAAKEKfjES8Wlo7BhTZtw6H9EtBcjA'
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl_tr"
            async defer>
    </script>

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

            <img src='/request-permission-app/public/images/logo3.png' alt="">


        </div>
        <?php if (isset($error)): ?>
            <div class="message error box-">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <ul>
                <li>
                    <label for="eposta">E-posta</label>
                    <input type="text" name="eposta">
                </li>
                <li>
                    <label for="sifre">Şifre</label>
                    <input type="password" name="sifre">
                </li>
		<div id="guvenlik1"></div>
		<br>
                <li>
                    <button name="submit" value="1" type="submit">Giriş</button>

                </li>
            </ul>
        </form>

        <div class="login-links">
            <a href="mail" class="lost-password">
                Şifremi Unuttum
            </a>

        </div>

    </div>

    </body>


</div>

</body>
</html>
