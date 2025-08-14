<?php
try {
    $db= new PDO('mysql:host=localhost;dbname=meritdesk','root', '');

}catch(PDOException $e){
    die($e->getMessage());
}
if (post('submit')){
    $ad= post('ad');
    $soyad = post('soyad');
    $eposta= post('eposta');
    $sifre = post('ad') . "." . post('soyad') . "1";
    $sirket=post('sirket');
    $departman=post('departman');
    $gorev=post('gorev');
    $yonetici1=post('yonetici1');
    $yonetici2=post('yonetici2');
    $yonetici3=post('yonetici3');
    $yonetici4=post('yonetici4');
    $isbaslangic=post('ise-baslangic');
    if (!$ad){
        $error = 'Lütfen Çalışan Adını Girin';
    }
    elseif (!$soyad){
        $error = 'Lütfen Çalışan Soyadını Girin';
    }
    elseif (!$eposta){
        $error = 'Lütfen Çalışan E-postasını Girin';
    }
    elseif (!filter_var($eposta, FILTER_VALIDATE_EMAIL)){
        $error = 'Lütfen Geçerli Bir E-posta Adresi Girin';
    }
    elseif (!$sirket){
        $error = 'Lütfen Şirket Seçin';
    }
    elseif (!$departman){
        $error = 'Lütfen Departman Seçin';
    }
    elseif (!$gorev){
        $error = 'Lütfen Görev Seçin';
    }
    elseif (!$isbaslangic){
        $error = 'Lütfen İşe Başlangıç Tarihini Seçin';
    }
    elseif (!$yonetici1){
        $error = 'Lütfen 1. Yöneticiyi Seçin';
    }
    else{
        $query = $db->prepare('SELECT * FROM users WHERE email = :eposta');
        $query->execute([
            'eposta' => $eposta
        ]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row){
            $error = 'Bu E-posta Başka Bir Çalışan Tarafından Kullanılmaktadır';
        }
        else{
            $query = $db->prepare('INSERT INTO  users SET name = :ad, surname = :soyad, email = :eposta,
               password = :sifre, company = :sirket, department = :departman, user_role = :gorev, manager1 = :yonetici1,
                manager2 = :yonetici2, manager3 = :yonetici3, manager4 = :yonetici4, start_date = :isbaslangic' );
            $result = $query->execute([
                'ad' => $ad,
                'soyad' => $soyad,
                'eposta' => $eposta,
                'sifre' => password_hash($sifre, PASSWORD_DEFAULT),
                'sirket' => $sirket,
                'departman' => $departman,
                'gorev' => $gorev,
                'yonetici1' => $yonetici1,
                'yonetici2' => $yonetici2,
                'yonetici3' => $yonetici3,
                'yonetici4' => $yonetici4,
                'isbaslangic' => $isbaslangic
            ]);
            if ($result){
                $success = 'Çalışan Kaydı Başarıyla Oluşturulmuştur';
            }
            else{
                $error = 'Bir Sorun Oluştu. Lütfen Daha Sonra Tekrar Deneyin';
            }
        }
    }
}

require admin_view('add-user');