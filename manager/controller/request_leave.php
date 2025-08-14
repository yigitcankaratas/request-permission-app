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



if (post('submit')){
    $izin_baslangic= post('izin-baslangic');
    $baslangic_gun = post('baslangic_gun');
    $izin_bitis= post('izin-bitis');
    $bitis_gun = post('bitis_gun');
    $izin_aciklama= post('izin_aciklama');
    $m1_email= post('y1_email');
    $m2_email= post('y2_email');
    $m3_email= post('y3_email');
    $m4_email= post('y4_email');
    $eposta= post('user_email');
    $company = post('user_company');
    $department = post('user_department');
    $kullanici = post('user_info');
    $calisma_baslangici = post('info_start_date');
    $bugun = date("Y-m-d");



    $query8 = $db->prepare('SELECT date FROM holidays' );
    $query8->execute([]);
    $row8 = $query8->fetchAll(PDO::FETCH_ASSOC);

    foreach ($row8 as $key => $value){
        $arr[$key]=$value['date'];
    }

    $query10 = $db->prepare('SELECT date FROM arefe' );
    $query10->execute([]);
    $row10 = $query10->fetchAll(PDO::FETCH_ASSOC);

    foreach ($row10 as $key => $value){
        $arr2[$key]=$value['date'];
    }

    $holidays = array_merge($arr,$arr2);

    $toplam_gun=getWorkingDays($izin_baslangic, $izin_bitis, $holidays);

    $query9 = $db->prepare("SELECT * FROM arefe WHERE date >= '$izin_baslangic' AND date <= '$izin_bitis' ");
    $query9->execute([]);
    $row9 = $query9->fetch(PDO::FETCH_ASSOC);
    if ($row9){
        $toplam_gun += 0.5;
    }

    if ($baslangic_gun){
        $toplam_gun -= 0.5;
    }
    if ($bitis_gun && ($izin_baslangic != $izin_bitis)){
        $toplam_gun -= 0.5;
    }
    if ($toplam_gun <= 0){
        $error = 'Lütfen Başlangıç ve Bitiş Tarihlerini Doğru Girin';
    }
    elseif (!$izin_baslangic){
        $error = 'Lütfen İzin Başlangıç Tarihini Girin';
    }
    elseif (!$izin_bitis){
        $error = 'Lütfen İzin Bitiş Tarihini Girin';
    }
    elseif (!$izin_aciklama){
        $error = 'Lütfen İzin Açıklamasını Girin';
    }
    else{
        $query = $db->prepare("SELECT * FROM leaves WHERE email = '$eposta' AND statue = 1");
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row){
            $error = 'Beklemede olan bir izin talebiniz bulunmaktadır. Lütfen bu talebin kapanması için yöneticinizle iletişime geçin';
        }
        else{
            $query = $db->prepare('INSERT INTO leaves SET email = :email, company_id = :company, department_id = :department , leave_start = :izin_baslangic,
               start_half_day = :baslangic_gun, leave_end = :izin_bitis, end_half_day = :bitis_gun, total_day = :toplam_gun,
                description = :izin_aciklama, m1 = :m1_email, m2 = :m2_email, m3 = :m3_email, m4 = :m4_email, statue = 1, request_date = :bugun' );
            $result = $query->execute([
                'email' => $eposta,
                'company' => $company,
                'department' => $department,
                'izin_baslangic' => $izin_baslangic,
                'baslangic_gun' => $baslangic_gun,
                'izin_bitis' => $izin_bitis,
                'bitis_gun' => $bitis_gun,
                'toplam_gun' => $toplam_gun,
                'izin_aciklama' => $izin_aciklama,
                'm1_email' => $m1_email,
                'm2_email' => $m2_email,
                'm3_email' => $m3_email,
                'm4_email' => $m4_email,
                'bugun' => $bugun
            ]);
            if ($result){
                $success = 'İzin Talebi Başarıyla Oluşturulmuştur';

                $xyillik = floor(((strtotime(date('Y-m-d')) - strtotime($calisma_baslangici)) / ((365 * 24 * 60 * 60)+ (6 * 60 * 60) )));
                $leave_right = 0;
                if($xyillik>=1 && $xyillik<6){
                    $leave_right = 14;
                }
                if($xyillik>=6 && $xyillik<15){
                    $leave_right = 20;
                }
                if($xyillik>=15){
                    $leave_right = 26;
                }
                $one_year_ago = date('Y-m-d', strtotime('+' . (string)($xyillik) . ' year', strtotime($calisma_baslangici)));
                $one_year_ago_year=date('Y', strtotime($one_year_ago));
                $one_year_ago_new=date("d-m-Y",strtotime($one_year_ago));
                $one_year_after =  date('Y', strtotime($one_year_ago))+1 . date('-m-d', strtotime($one_year_ago))  ;
                $total_leave = 0;
                $query1 = $db->prepare("SELECT * FROM leaves WHERE email = '$eposta' AND statue = 2 AND leave_start >= ' $one_year_ago' AND leave_start < '$one_year_after'");
                $query1->execute();
                $row1 = $query1->fetchAll(PDO::FETCH_ASSOC);
                foreach ($row1 as $arr) {
                    $total_leave += $arr['total_day'];
                }
                $res = $leave_right - $total_leave - $toplam_gun;

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
                $mail->setFrom('merithrms@gmail.com', 'meritdesk');
                if ($m1_email){
                    $mail->addAddress($m1_email);
                }
                if ($m2_email){
                    $mail->addAddress($m2_email);
                }
                if ($m3_email){
                    $mail->addAddress($m3_email);
                }
                if ($m4_email){
                    $mail->addAddress($m4_email);
                }

                $mail->addAddress($eposta);

                //$mail->addReplyTo('info@uzmancevap.org', 'Uzman Cevap');




                //$mail->addAttachment('PHPMailer-master.zip', 'phpmailkullanimi.zip');
                $subject = 'İzin Talebi';
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->AddEmbeddedImage('C:\xampp\htdocs\meritdesk\public\images\logo3.jpg', 'logo');
                $mail->Body    =  "<p align='center'><img src=\"cid:logo\" ></p>" .
                    "<h3 align='center'>MeritDesk Otomatik Bilgilendirme Servisi</h3>".
                    "<p>Aşağıda bilgileri verilen izin talebi oluşturmuştur ve yönetici onayı beklemektedir.</p><br/>".


                    "<table width='100%' style='border:1px solid black;border-collapse:collapse;white-space:nowrap;background-color:#ffffff' align='left class='table'>" .
                    "<tr><th colspan='2' style='border:1px solid black;text-align:center;white-space:nowrap;background-color:#ffffff'>MeritDesk İzin Talep Bilgilendirmesi</th>".
                    "<tr><th style='border:1px solid black;text-align:left;white-space:nowrap;background-color:#cfcfcf'>İzin Talep Sahibi</th>" .
                    "<td style='border:1px solid black;text-align:left;white-space:nowrap;background-color:#cfcfcf'>".$kullanici."</td></tr>".
                    "<tr><th style='border:1px solid black;text-align:left;white-space:nowrap'>İzin Başlangıcı</th>".
                    "<td style='border:1px solid black;text-align:left;white-space:nowrap'> ". $izin_baslangic."</td></tr>".
                    "<tr><th style='border:1px solid black;text-align:left;white-space:nowrap;background-color:#cfcfcf'>İzin Bitişi</th>".
                    "<td style='border:1px solid black;text-align:left;white-space:nowrap;background-color:#cfcfcf'> ".$izin_bitis."</td></tr>".
                    "<tr><th style='border:1px solid black;text-align:left;white-space:nowrap'>Toplam Gün Sayısı</th>".
                    "<td style='border:1px solid black;text-align:left;white-space:nowrap'> ".$toplam_gun."</td></tr>";


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
            else{
                $error = 'Bir Sorun Oluştu. Lütfen Daha Sonra Tekrar Deneyin';
            }
        }
    }
}

require manager_view('request_leave');
