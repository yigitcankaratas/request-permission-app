


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
            <?php

            try {
                $db= new PDO('mysql:host=localhost;dbname=meritdesk','root', '');

            }catch(PDOException $e){
                die($e->getMessage());
            }


            $eposta = $_GET['eposta'];
            $kod    = $_GET["id"];

            if(!$eposta || !$kod){




            }else {

                $query = $db->prepare("select * from users where email=? and id=?");
                $query->execute(array($eposta,$kod));
                $query->fetch(PDO::FETCH_ASSOC);
                $kontrol = $query->rowCount();

                if($kontrol){


                    if($_POST){

                        $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT);
                        $sifre2 = password_hash($_POST['sifre2'], PASSWORD_DEFAULT);

                        if(!$_POST['sifre']){

                            echo '<div style="margin-top:20px;" class="alert alert-warning">Şifre boş bırakılamaz</div>';


                        }
                        elseif($_POST['sifre'] != $_POST['sifre2']){

                            echo '<div style="margin-top:20px;" class="alert alert-warning">Yazdığınız şifreler uyuşmuyor</div>';


                        }
                        else {

                            $update = $db->prepare("update users set password=? where email=? and id=?");
                            $ok = $update->execute(array($sifre,$eposta,$kod));

                            if($ok == true){

                                echo '<div style="margin-top:20px;" class="alert alert-success">Şifreniz başarıyla değiştirildi</div>';

                            }else {

                                echo '<div style="margin-top:20px;" class="alert alert-warning">Şifreniz değiştirilirken bir hata oluştu. Lütfen sistem yöneticisine başvurun</div>';



                            }


                        }



                    }else {

                        ?>
                        <form action="" method="post">

                            <label for="eposta"><h3>Yeni Şifre</h3></label>
                            <input type="password" name="sifre" class="form-control" id="eposta" placeholder="Şifre" /> <br>
                            <input type="password" name="sifre2" class="form-control" id="eposta" placeholder="Şifre Tekrar" /> <br>


                            <button type="submit" class="btn btn-primary">Gönder</button>


                        </form>
                        <?php

                    }




                }else {

                    echo '<div style="margin-top:20px;" class="alert alert-warning">Onay kodu yanlış ya da daha önce onaylanmış</div>';

                }


            }



            ?>




        </div>
    </body>
</div>
</body>
</html>