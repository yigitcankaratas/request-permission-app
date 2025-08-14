<?php
try {
    $db= new PDO('mysql:host=localhost;dbname=meritdesk','root', '');

}catch(PDOException $e){
    die($e->getMessage());
}
if (post('submit')){
    $department= post('department');
    if (!$department){
        $error = 'Lütfen Departman Adını Girin';
    }
    else{
        $query = $db->prepare('SELECT * FROM departments WHERE department = :department');
        $query->execute([
            'department' => $department
        ]);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row){
            $error = 'Bu Departman Zaten Kayıtlıdır';
        }
        else{
            $query = $db->prepare('INSERT INTO  departments SET department = :department' );
            $result = $query->execute([
                'department' => $department
            ]);
            if ($result){
                $success = 'Departman Kaydı Başarıyla Oluşturulmuştur';
            }
            else{
                $error = 'Bir Sorun Oluştu. Lütfen Daha Sonra Tekrar Deneyin';
            }
        }
    }
}

require admin_view('add-department');