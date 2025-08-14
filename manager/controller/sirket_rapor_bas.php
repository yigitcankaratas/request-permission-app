<?php
function array_to_csv_function($array, $filename = "export.csv", $delimiter = ";")
{
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
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    echo "\xEF\xBB\xBF";
    // Üretilen CSV tarayıcıya iletiliyor.
    fpassthru($f);
}

$mail = end($_SESSION);
$query7 = $db->prepare("SELECT * FROM users WHERE email= '$mail'");
$query7->execute([]);
$row7 = $query7->fetch(PDO::FETCH_ASSOC);
$comp = $row7['company'];


$sirket = $comp = $row7['company'];
if (!$sirket) {
    exit();
}


$satir[0] = array("Ad", "Soyad", "İzin Başlangıç", "Yarım Gün", "İzin Bitiş", "Yarım Gün", "Talep Toplamı", "Geçerli İzin Dönemi" , "Kalan İzin");
$i = 1;
$query4 = $db->prepare('SELECT * FROM leaves WHERE company_id = :company_id');
$query4->execute([
    'company_id' => $sirket
]);
$row4 = $query4->fetchAll(PDO::FETCH_ASSOC);

foreach ($row4 as $satirlar) {
    if ($satirlar['statue'] == 2) {
        if ($satirlar['start_half_day'] == 0)
            $satirlar['start_half_day'] = 'Hayır';
        else
            $satirlar['start_half_day'] = 'Evet';
        if ($satirlar['end_half_day'] == 0)
            $satirlar['end_half_day'] = 'Hayır';
        else
            $satirlar['end_half_day'] = 'Evet';
        $query3 = $db->prepare('SELECT * FROM users WHERE email = :email');
        $query3->execute([
            'email' => $satirlar['email']
        ]);
        $row5 = $query3->fetch(PDO::FETCH_ASSOC);
        $row1 = $query4->fetch(PDO::FETCH_ASSOC);
        $eposta = $row5['email'];
        $baslangic = $row5['start_date'];
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
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $arr) {
            $total_leave += $arr['total_day'];
        }
        $satir[$i] = array($row5['name'], $row5['surname'], $satirlar['leave_start'], $satirlar['start_half_day'], $satirlar['leave_end'], $satirlar['end_half_day'], $satirlar['total_day'], $takvim_aralik, $leave_right - $total_leave);
        $i++;

    } else {

    }
}

$icerik = $satir;
array_to_csv_function($icerik, "MeritDesk Şirket Raporu" . date("Y-m-d") . ".csv");
