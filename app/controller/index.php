<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=meritdesk', 'root', '');

} catch (PDOException $e) {
    die($e->getMessage());
}


$tarih = date("Y-m-d");
$query6 = $db->prepare("SELECT * FROM leaves WHERE leave_start < '$tarih' AND statue = 1 ");
$query6->execute();
$row6 = $query6->fetchAll(PDO::FETCH_ASSOC);
if(isset($row6)){
    foreach ($row6 as $satirlar){
        $id=$satirlar['id'];
        $query5 = $db->prepare("UPDATE leaves SET statue = 3, statue_id = -1 WHERE id = '$id' ");
        $query5->execute();
    }
}


gogogo:
if (is_string(end($_SESSION))) {

    $query3 = $db->prepare("SELECT user_role FROM users WHERE email = :eposta");
    $query3->execute([
        'eposta' => end($_SESSION)
    ]);
    $row3 = $query3->fetch(PDO::FETCH_ASSOC);
    //echo $row3;
    if ($row3['user_role'] == 1) {
        header('Location: /meritdesk/admin/');
        //require admin_controller('index');
    } elseif ($row3['user_role'] == 2) {
        header('Location: /meritdesk/manager/');
        //require manager_controller('index');
    } elseif ($row3['user_role'] == 3) {
        header('Location: /meritdesk/user/');
        //require user_controller('index');
    } elseif ($row3['user_role'] == 4) {
        header('Location: /meritdesk/teamlead/');
        //require user_controller('index');
    }
} else {
    $flag = 0;
    if (post('submit')) {
	$recaptcha = $_POST['g-recaptcha-response'];
        if ((post('eposta') && post('sifre') && $recaptcha)) {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => 'secret=6Lc6uKUrAAAAAKADVIHvZ_evD5t5Ws6jeOobxuuU&response='. $recaptcha,
                CURLOPT_RETURNTRANSFER => true
            ]);
            $output = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($output, true);

            if ($result['success'] === true) {
                $query = $db->prepare('SELECT * FROM users WHERE email = :eposta');
                $query->execute([
                    'eposta' => post('eposta')
                ]);
                $row = $query->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    $query2 = $db->prepare("SELECT password FROM users WHERE email = :eposta");
                    $query2->execute([
                        'eposta' => post('eposta')
                    ]);
                    $row2 = $query2->fetch(PDO::FETCH_ASSOC);
                    if (password_verify(post('sifre'), $row2['password'])) {
                        $_SESSION[post('eposta')] = post('eposta');
                        $flag = 1;
                    } else {
                        $error = 'Girdiğiniz Parola Hatalı';
                    }
                } else {
                    $error = 'Girdiğiniz E-posta Adresi Hatalı';
                }
            }
        } else {
            $error = 'Lütfen bilgilerinizi girin ve reCAPTCHA\'yı doğrulayın';
        }
    }
    if ($flag == 0) {
        include "login.php";
    } else {
        goto gogogo;
    }

}
/* session var mı kontrol et
session yoksa login.php'ye yönlendir
session varsa role'u kontrol et
admin rolündekileri admin location'ına
manager rolündekileri manager location'ına
user rolündekileri user location'ına yönlendir.
*/