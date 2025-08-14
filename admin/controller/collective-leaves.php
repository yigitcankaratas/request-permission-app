<?php

try {
    $db= new PDO('mysql:host=localhost;dbname=meritdesk','root', '');

}catch(PDOException $e){
    die($e->getMessage());
}
if (post('submit')){
    $toplu_izin= 0.5;
    if (!$toplu_izin){
        $error = 'Lütfen Bir Değer Girin';
    }
    else{

        $query = $db->prepare('SELECT * FROM users' );
        $query->execute([]);
        $row = $query->fetchAll(PDO::FETCH_ASSOC);


        foreach ($row as $kisiler){
            $izin_baslangic= date("Y-m-d");
            $baslangic_gun = 1;
            $izin_bitis= date("Y-m-d");
            $bitis_gun = 0;
            $izin_aciklama= "Toplu İzin";
            $m1_email= 'merithrms@gmail.com';
            $m2_email= 'merithrms@gmail.com';
            $m3_email= 'merithrms@gmail.com';
            $m4_email= 'merithrms@gmail.com';
            $eposta= $kisiler['email'];
            $company = $kisiler['company'];
            $kullanici = $kisiler['name'] . " " . $kisiler['surname'];
            $calisma_baslangici = $kisiler['start_date'];
            $bugun = date("Y-m-d");

            $query8 = $db->prepare('SELECT date FROM holidays' );
            $query8->execute([]);
            $row8 = $query8->fetchAll(PDO::FETCH_ASSOC);

            foreach ($row8 as $key => $value){
                $arr[$key]=$value['date'];
            }

            $holidays = $arr;

            $toplam_gun=getWorkingDays($izin_baslangic, $izin_bitis, $holidays);

            if ($baslangic_gun){
                $toplam_gun -= 0.5;
            }
            if ($bitis_gun && ($izin_baslangic != $izin_bitis)){
                $toplam_gun -= 0.5;
            }

            $query2 = $db->prepare('INSERT INTO leaves SET email = :email, company_id = :company, leave_start = :izin_baslangic,
       start_half_day = :baslangic_gun, leave_end = :izin_bitis, end_half_day = :bitis_gun, total_day = :toplam_gun,
        description = :izin_aciklama, m1 = :m1_email, m2 = :m2_email, m3 = :m3_email, m4 = :m4_email, statue = 2, request_date = :bugun' );
            $result = $query2->execute([
                'email' => $eposta,
                'company' => $company,
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

        }

        if ($result){
            $success = 'Toplu İzinler Başarıyla Oluşturulmuştur';
        }
        else{
            $error = 'Bir Sorun Oluştu. Lütfen Daha Sonra Tekrar Deneyin';
        }
    }
}

require admin_view('collective-leaves');