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



if (post('submit')){



    $row2 = $db->from('users')
        ->where('company', $row1['id'])
        ->first();
    if(!is_array($row2)){
        $query = $db->delete('companies')
            ->where('id', $id)
            ->done();
    }
    else
    {
        $error = 'Bu Şirkete Kayıtlı Kullanıcıları Düzenleyin veya Silin';
        goto c;
    }
    if ($query){
        $success = 'Şirket Kaydı Başarıyla Silinmiştir';
    }
    else{
        $error = 'Bir Sorun Oluştu. Lütfen Daha Sonra Tekrar Deneyin';
    }
    c:
}



require admin_view('delete-companies');