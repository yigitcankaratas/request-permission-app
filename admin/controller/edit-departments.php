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

$flag1 = 0;

if (post('submit')){
    $department = post('department');

    if (!$department || $department == $row1['department']){

    }
    else {
        $row3 = $db->from('departments')
            ->where('department', $department)
            ->first();

        if (isset($row3['department'])) {

            $error = 'Bu Departman Kullanılmaktadır';
            goto b;
        }
        else{
            $row3= $db->update('departments')
                ->where('id', $id)
                ->set('department', $department);
                $flag1 = 1;
        }
    }

    if ($flag1){
        $success = 'Departman Kaydı Başarıyla Düzenlenmiştir';
    }
    else{
        $error = 'Bir Sorun Oluştu. Lütfen Daha Sonra Tekrar Deneyin';
    }
b:
}



require admin_view('edit-departments');