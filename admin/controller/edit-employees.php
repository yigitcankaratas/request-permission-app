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
$row = $db->from('users')
    ->where('id', $id)
    ->first();

if (post('submit')){

    $ad= post('ad');
    $soyad = post('soyad');
    $eposta= post('eposta');
    $sirket=post('sirket');
    $departman=post('departman');
    $gorev=post('gorev');
    $yonetici1=post('yonetici1');
    $yonetici2=post('yonetici2');
    $yonetici3=post('yonetici3');
    $yonetici4=post('yonetici4');

    if (!$ad || $ad == $row['name']){

    }
    else{
        $row2= $db->update('users')
            ->where('id', $id)
            ->set('name', $ad);


    }
    if (!$soyad || $soyad == $row['surname']){

    }
    else{
        $row2= $db->update('users')
            ->where('id', $id)
            ->set('surname', $soyad);


    }
    if (!$eposta || $eposta == $row['email']){

    }
    else{

        $row2 = $db->from('users')
            ->where('email',$eposta)
            ->first();
        if (isset($row2['email'])){

            $error = 'Bu E-posta Başka Bir Çalışan Tarafından Kullanılmaktadır';
            goto a;

        }
        else{
        $row2= $db->update('users')
            ->where('id', $id)
            ->set('email', $eposta);
        }

    }
    if (!$sirket || $sirket == $row['company']){

    }
    else{
        $row2= $db->update('users')
            ->where('id', $id)
            ->set('company', $sirket);


    }
    if (!$departman || $departman == $row['department']){

    }
    else{
        $row2= $db->update('users')
            ->where('id', $id)
            ->set('department', $departman);


    }
    if (!$gorev || $gorev == $row['user_role']){

    }
    else{
        $row2= $db->update('users')
            ->where('id', $id)
            ->set('user_role', $gorev);


    }
    if (!$yonetici1 || $yonetici1 == $row['manager1']){

    }
    else{
        $row2= $db->update('users')
            ->where('id', $id)
            ->set('manager1', $yonetici1);
    }
    if (!$yonetici2 || $yonetici2 == $row['manager2']){

    }
    else{
        $row2= $db->update('users')
            ->where('id', $id)
            ->set('manager2', $yonetici2);
    }
    if (!$yonetici3 || $yonetici3 == $row['manager3']){

    }
    else{
        $row2= $db->update('users')
            ->where('id', $id)
            ->set('manager3', $yonetici3);
    }
    if (!$yonetici4 || $yonetici4 == $row['manager4']){

    }
    else{
        $row2= $db->update('users')
            ->where('id', $id)
            ->set('manager4', $yonetici4);
    }
    if ($row2){
        $success = 'Çalışan Kaydı Başarıyla Düzenlenmiştir';
    }
    else{
        $error = 'Bir Sorun Oluştu. Lütfen Daha Sonra Tekrar Deneyin';
    }
a:
}



require admin_view('edit-employees');