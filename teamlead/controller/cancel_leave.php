<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'app/src/Exception.php';
require 'app/src/PHPMailer.php';
require 'app/src/SMTP.php';


$id = get('id');


$query6 = $db->prepare("SELECT * FROM leaves WHERE id = '$id' ");
$query6->execute();
$row6 = $query6->fetch(PDO::FETCH_ASSOC);


if ($row6['leave_start'] < date("Y-m-d")){
    $error = 'Başlangıç tarihi geçmiş olan izinler iptal edilemez';
}
else {
    $query5 = $db->prepare("UPDATE leaves SET statue = 3, statue_id = -2 WHERE id = '$id' ");
    $query5->execute();
    $success = 'İzin durumu başarıyla güncellendi';

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
    if ($row6['m1']){
        $mail->addAddress($row6['m1']);
    }
    if ($row6['m2']){
        $mail->addAddress($row6['m2']);
    }
    if ($row6['m3']){
        $mail->addAddress($row6['m3']);
    }
    if ($row6['m4']){
        $mail->addAddress($row6['m4']);
    }

    $mail->addAddress($row6['email']);

//$mail->addReplyTo('info@uzmancevap.org', 'Uzman Cevap');

    $posta = $row6['email'];

    $query7 = $db->prepare("SELECT * FROM users WHERE email = '$posta' ");
    $query7->execute();
    $row7 = $query7->fetch(PDO::FETCH_ASSOC);


    $e_mail=end($_SESSION);
    $query8 = $db->prepare("SELECT * FROM users WHERE email = '$e_mail' ");
    $query8->execute();
    $row8 = $query8->fetch(PDO::FETCH_ASSOC);

//$mail->addAttachment('PHPMailer-master.zip', 'phpmailkullanimi.zip');
    $subject = 'İzin Talebi Durum Güncellemesi';
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->AddEmbeddedImage('C:\xampp\htdocs\meritdesk\public\images\logo3.jpg', 'logo');
    $mail->Body    =  "<p align='center'><img src=\"cid:logo\" ></p>" .
        "<h3 align='center'>MeritDesk Otomatik Bilgilendirme Servisi</h3>".
        "<p>Aşağıda bilgileri verilen izin talebi, " . $row8['name'] . " " . $row8['surname'] . " tarafından iptal edilmiştir.</p><br/>".


        "<table width='100%' style='border:1px solid black;border-collapse:collapse;white-space:nowrap;background-color:#ffffff' align='left class='table'>" .
        "<tr><th colspan='2' style='border:1px solid black;text-align:center;white-space:nowrap;background-color:#ffffff'>MeritDesk İzin Talep Bilgilendirmesi</th>".
        "<tr><th style='border:1px solid black;text-align:left;white-space:nowrap;background-color:#cfcfcf'>İzin Talep Sahibi</th>" .
        "<td style='border:1px solid black;text-align:left;white-space:nowrap;background-color:#cfcfcf'>".$row7['name'] . " " . $row7['surname']."</td></tr>".
        "<tr><th style='border:1px solid black;text-align:left;white-space:nowrap'>İzin Başlangıcı</th>".
        "<td style='border:1px solid black;text-align:left;white-space:nowrap'> ". $row6['leave_start']."</td></tr>".
        "<tr><th style='border:1px solid black;text-align:left;white-space:nowrap;background-color:#cfcfcf'>İzin Bitişi</th>".
        "<td style='border:1px solid black;text-align:left;white-space:nowrap;background-color:#cfcfcf'> ".$row6['leave_end']."</td></tr>".
        "<tr><th style='border:1px solid black;text-align:left;white-space:nowrap'>Toplam Gün Sayısı</th>".
        "<td style='border:1px solid black;text-align:left;white-space:nowrap'> ".$row6['total_day']."</td></tr>";


    $mail->Body.=       "</table><br/>".
               "<p>İzin talebi ve yapılan güncellemeler hakkında daha detaylı bilgi almak için lütfen MeritDesk uygulamasına giriş yapınız.</p><br/>".
        "<table width=\"100%\" align='center' border=\"0\" cellspacing=\"0\" cellpadding=\"0\">".
        "<tr>".
        "<td>".
        "<table align='center' border=\"0\" cellspacing=\"0\" cellpadding=\"0\">".
        "<tr>".
        "<td align=\"center\" style=\"border-radius: 3px;\" bgcolor=\"#0F5BA9\"><a href=\"http://195.175.33.158:8916/meritdesk/\" target=\"_blank\" style=\"font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; text-decoration: none;border-radius: 3px; padding: 12px 18px; border: 1px solid #0F5BA9; display: inline-block;\">MeritDesk &rarr;</a></td>".
        "</tr>".
        "</table>".
        "</td>".
        "</tr>".
        "</table>";
    $mail->send();

}


require teamlead_controller('leave-requests');
