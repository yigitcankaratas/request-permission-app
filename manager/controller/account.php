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

$email = isset($_POST['email']) ? $_POST['email'] : null;




$query = $db->prepare("SELECT * FROM users WHERE email=?");
$query->execute(array($email));
$row_a = $query->fetch(PDO::FETCH_ASSOC);







if (!$email) {
    $error = 'E-posta adresini girin.';

} elseif (!isset($row_a['email'])) {

    $error =  'Lütfen geçerli bir e-posta adresi yazın.';

} elseif ($email!=end($_SESSION)) {

$error =  'Lütfen kendi e-posta adresinizi giriniz';

}
else {

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
    $mail->addAddress($email);
    //$mail->addReplyTo('info@uzmancevap.org', 'Uzman Cevap');

    $subject = 'Yeni Şifre';
    $mail->isHTML(true);
    $mail->Subject = $subject;
    //$mail->Body = $content;
    $mail->AddEmbeddedImage('C:\xampp\htdocs\meritdesk\public\images\logo3.jpg', 'logo');


    $mail->Body = $mail->Body    =
        "<p align='center'><img src=\"cid:logo\" ></p>" .
        "<h3 align='center'>MeritDesk Otomatik Bilgilendirme Servisi</h3>".
    "<p>Şifre sıfırlama talebiniz tarafımıza ulaşmıştır. Şifrenizi değiştirmek için Şifremi Sıfırla butonunu kullanınız.</p><br/>".
    "<table width=\"100%\" align='center' border=\"0\" cellspacing=\"0\" cellpadding=\"0\">".
    "<tr>".
    "<td>".
    "<table align='center' border=\"0\" cellspacing=\"0\" cellpadding=\"0\">".
    "<tr>".
    "<td align=\"center\" style=\"border-radius: 3px;\" bgcolor=\"#0F5BA9\"><a href=\"http://195.175.33.158:8916/meritdesk/yenisifre?eposta=" . $email . "&id=" . $row_a['id']  . "\" target=\"_blank\" style=\"font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; text-decoration: none;border-radius: 3px; padding: 12px 18px; border: 1px solid #0F5BA9; display: inline-block;\">Şifremi Sıfırla &rarr;</a></td>".
    "</tr>".
    "</table>".
    "</td>".
    "</tr>".
    "</table>";



    $mail->send();

    $success = "Şifrenizi Değiştirmek İçin E-postanıza Mail Gönderildi";



}





require manager_view('newpass_account');