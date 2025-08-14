<?php

try {
    $db = new BasicDB('localhost','meritdesk','root', '');

}catch(PDOException $e){
    die($e->getMessage());
}
$id = get('id');
if (!$id){
    header('Location:' . admin_url('companies'));
    exit;
}
$row1 = $db->from('companies')
    ->where('id', $id)
    ->first();

$flag1 = 0;

if (post('submit')){
    $company = post('company');

    if (!$company || $company== $row1['company']){

    }
    else {
        $row3 = $db->from('companies')
            ->where('company', $company)
            ->first();

        if (isset($row3['company'])) {

            $error = 'Bu Departman Kullanılmaktadır';
            goto b;
        }
        else{
            $row3= $db->update('companies')
                ->where('id', $id)
                ->set('company', $company);
                $flag1 = 1;
        }
    }

    if ($flag1){
        $success = 'Şirket Kaydı Başarıyla Düzenlenmiştir';
    }
    else{
        $error = 'Bir Sorun Oluştu. Lütfen Daha Sonra Tekrar Deneyin';
    }
b:
}



require admin_view('edit-companies');