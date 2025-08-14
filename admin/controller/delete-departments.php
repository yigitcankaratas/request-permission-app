<?php
try {
    $db = new BasicDB('localhost','meritdesk','root', '');

}catch(PDOException $e){
    die($e->getMessage());
}
$id = get('id');
if (!$id){
    header('Location:' . admin_url('departments'));
    exit;
}
$row1 = $db->from('departments')
    ->where('id', $id)
    ->first();



if (post('submit')){



    $row2 = $db->from('users')
        ->where('department', $row1['id'])
        ->first();
    if(!is_array($row2)){
        $query = $db->delete('departments')
            ->where('id', $id)
            ->done();
    }
    else
    {
        $error = 'Bu Departmana Kayıtlı Kullanıcıları Düzenleyin veya Silin';
        goto c;
    }
    if ($query){
        $success = 'Departman Kaydı Başarıyla Silinmiştir';
    }
    else{
        $error = 'Bir Sorun Oluştu. Lütfen Daha Sonra Tekrar Deneyin';
    }
c:
}



require admin_view('delete-departments');