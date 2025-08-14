<?php
try {
    $db = new BasicDB('localhost','meritdesk','root', '');

}catch(PDOException $e){
    die($e->getMessage());
}
$id = get('id');
if (!$id){
    header('Location:' . admin_url('users'));
    exit;
}
$row1 = $db->from('users')
    ->where('id', $id)
    ->first();



if (post('submit')){





        $query = $db->delete('users')
            ->where('id', $id)
            ->done();

    if ($query){
        $success = 'Çalışan Kaydı Başarıyla Silinmiştir';
    }
    else{
        $error = 'Bir Sorun Oluştu. Lütfen Daha Sonra Tekrar Deneyin';
    }

}



require admin_view('delete-employees');