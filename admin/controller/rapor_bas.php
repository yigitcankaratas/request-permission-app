<?php
function array_to_csv_function($array, $filename = "export.csv", $delimiter=";") {
    // Bir temp dosyası açmak yerine bellek alanı kullanıyoruz.
    $f = fopen('php://memory', 'w');
    // Verilerimizin olduğu diziyi döngüye sokuyoruz
    foreach ($array as $line) {
        // Dizimizin içindeki her dizi, CSV dosyamızda bir satır olmaktadır.
        fputcsv($f, $line, $delimiter);
    }
    // Dosya başlangıc işaretini sıfırlıyor
    fseek($f, 0);
    header('Content-Encoding: UTF-8');
    // Tarayıcıya bir csv dosyası olduğunu belirtiyor
    header('Content-Type: application/csv; charset=UTF-8');
    // Tarayıcıya görüntülenmek için olmadığını, kaydedilmek için olduğunu belirtiyor.
    header('Content-Disposition: attachment; filename="'.$filename.'";');
    echo "\xEF\xBB\xBF";
    // Üretilen CSV tarayıcıya iletiliyor.
    fpassthru($f);
}

$query2 = $db->prepare('SELECT * FROM users');
$query2->execute([]);
$row2 = $query2->fetchAll(PDO::FETCH_ASSOC);




$satir[0] = array("Ad", "Soyad", "Şirket" , "Departman", "Görev", "Geçerli İzin Dönemi" , "Kalan İzin");
$i=1;
foreach ($row2 as $satirlar){
    $sirketler = $satirlar['company'];
    $query1 = $db->prepare("SELECT * FROM companies WHERE id = '$sirketler' ");
    $query1->execute([]);
    $row1 = $query1->fetch(PDO::FETCH_ASSOC);
    $departman = $satirlar['department'];
    $query5 = $db->prepare("SELECT * FROM departments WHERE id = '$departman' ");
    $query5->execute([]);
    $row = $query5->fetch(PDO::FETCH_ASSOC);
    $query3 = $db->prepare('SELECT * FROM leaves WHERE email = :email');
    $query3->execute([
        'email' => $satirlar['email']
    ]);
    $row4 = $query3->fetch(PDO::FETCH_ASSOC);
    if ($satirlar['user_role'] == 1)
        $satirlar['user_role'] = 'Admin';
    if ($satirlar['user_role'] == 2)
        $satirlar['user_role'] = 'Yönetici';
    if ($satirlar['user_role'] == 3)
        $satirlar['user_role'] = 'Çalışan';
    if ($satirlar['user_role'] == 4)
        $satirlar['user_role'] = 'Takım Lideri';

    $eposta = $satirlar['email'];
    $baslangic = $satirlar['start_date'];
    $xyillik = floor(((strtotime(date('Y-m-d')) - strtotime($baslangic)) / ((365 * 24 * 60 * 60)+ (6 * 60 * 60) )));
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
    $one_year_ago = date('Y-m-d', strtotime('+' . (string)($xyillik) . ' year', strtotime($baslangic)));
    $one_year_ago_year=date('Y', strtotime($one_year_ago));
    $one_year_ago_new=date("d-m-Y",strtotime($one_year_ago));
    $one_year_after =  date('Y', strtotime($one_year_ago))+1 . date('-m-d', strtotime($one_year_ago))  ;
    $takvim_aralik = $one_year_ago_new . " / " . date('d-m-', strtotime($baslangic)) . ($one_year_ago_year + 1);
    $total_leave = 0;
    $query = $db->prepare("SELECT * FROM leaves WHERE email = '$eposta' AND statue = 2 AND leave_start >= ' $one_year_ago' AND leave_start < '$one_year_after'");
    $query->execute();
    $row0 = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($row0 as $arr){
        $total_leave += $arr['total_day'];
    }

    $satir[$i]= array($satirlar['name'],$satirlar['surname'],$row1['company'],$row['department'],$satirlar['user_role'], $takvim_aralik, $leave_right-$total_leave);
    $i++;
}



$icerik = $satir;
array_to_csv_function($icerik, "MeritDesk Çalışan Raporu" . date("Y-m-d") . ".csv");
