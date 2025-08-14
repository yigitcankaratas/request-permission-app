<?php
try {
    $db= new PDO('mysql:host=localhost;dbname=meritdesk','root', '');

}catch(PDOException $e){
    die($e->getMessage());
}
if (post('submit')){
    $company = post('company');
    if (!$company){
        $error = 'Lütfen Şirket Adını Girin';
    }
    else{
        $query = $db->prepare('SELECT * FROM companies WHERE company = :company');
        $query->execute([
            'company' => $company
        ]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row){
            $error = 'Bu Şirket Zaten Kayıtlıdır';
        }
        else{
            $query = $db->prepare('INSERT INTO  companies SET company = :company' );
            $result = $query->execute([
                'company' => $company
            ]);
            if ($result){
                $success = 'Şirket Kaydı Başarıyla Oluşturulmuştur';
            }
            else{
                $error = 'Bir Sorun Oluştu. Lütfen Daha Sonra Tekrar Deneyin';
            }
        }
    }
}

require admin_view('add-company');