<?php
try {
    $db= new PDO('mysql:host=localhost;dbname=meritdesk','root', '');

}catch(PDOException $e){
    die($e->getMessage());
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'app/src/Exception.php';
require 'app/src/PHPMailer.php';
require 'app/src/SMTP.php';
$sorgu = $db -> query('SELECT email FROM users');
$eposta = $sorgu->fetchAll(PDO::FETCH_ASSOC);

if (post('submit')){
    $baslik = post('duyuru_baslik');
    $aciklama = post('duyuru_aciklama');
    if (!$baslik){
        $error = 'Lütfen Başlık Girin';
    }
    elseif (!$aciklama){
        $error = 'Lütfen Açıklama Girin';
    }
    else{

            $query = $db->prepare('INSERT INTO  announcements SET announcement_head = :head, announcement_text = :text ');
            $result = $query->execute([
                'head' => $baslik,
                'text' => $aciklama
            ]);
            if ($result){
                $success = 'Duyuru Kaydı Başarıyla Oluşturulmuştur';

                $mail = new PHPMailer(true);

                $mail->setLanguage('tr');
                //$mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'merithrms@gmail.com';
                $mail->Password = 'Passw00rd123.';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->CharSet = 'UTF-8';

                // maili gönderen kişi
                $mail->setFrom('merithrms@gmail.com', 'MeritDesk');
                foreach ($eposta as $posta){
                    $mail->addAddress($posta ['email']) ;
                }
                //$mail->addReplyTo('info@uzmancevap.org', 'Uzman Cevap');

                //$mail->addAttachment('PHPMailer-master.zip', 'phpmailkullanimi.zip');

                $mail->isHTML(true);
                $mail->Subject = $baslik;
                $mail->AddEmbeddedImage('C:\xampp\htdocs\meritdesk\public\images\logo3.jpg', 'logo');
                $mail->Body = $mail->Body    =
                    "<p align='center'><img src=\"cid:logo\" ></p>" .
                    "<h3 align='center'>MeritDesk Duyuru Bilgilendirme Servisi</h3>".
                    "<p>". $aciklama ."</p><br/>";

                $mail->send();

            }
            else{
                $error = 'Bir Sorun Oluştu. Lütfen Daha Sonra Tekrar Deneyin';
            }

    }
}

require admin_controller('index');