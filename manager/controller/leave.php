<?php

try {
    $db = new BasicDB('localhost','meritdesk','root', '');

}catch(PDOException $e){
    die($e->getMessage());
}
$totalRecord = $db-> from('leaves')
    ->select('count(id) as total')
    ->total();

$pageLimit = 100;
$pageParam = 'page';
$pagination = $db->pagination($totalRecord, $pageLimit, $pageParam);

$mail=end($_SESSION);



$query = $db->from('leaves')
    ->where('email', $mail)
    ->orderby('id', 'DESC')
    ->limit($pagination['start'], $pagination['limit'])
    ->all();

require manager_view('my-leaves');
