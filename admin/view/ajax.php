<?php


try {
    $db = new PDO('mysql:host=localhost;dbname=meritdesk', 'root', '');

} catch (PDOException $e) {
    die($e->getMessage());
}



if (isset($_POST['company_id'])){

    $company_id = $_POST['company_id'];


    //$sorgu = $db->prepare('SELECT * FROM users WHERE company = ?');
    //$sorgu->execute([$company_id]);

    $sorgu = $db->prepare('SELECT * FROM users');
    $sorgu->execute();
    $managers = $sorgu->fetchAll(PDO::FETCH_ASSOC);

    $html = '<option>- Yönetici Seçin -</option>';
    foreach ($managers as $manager){
        $html .= '<option value="' . $manager['id'] . '">' . $manager['name'] . " " .  $manager['surname'] . '</option>';
    }

    echo $html;

}