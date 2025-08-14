<?php
try {
    $db = new BasicDB('localhost','meritdesk','root', '');

}catch(PDOException $e){
    die($e->getMessage());
}
$totalRecord = $db-> from('users')
    ->select('count(id) as total')
    ->total();

$pageLimit = 100;
$pageParam = 'page';
$pagination = $db->pagination($totalRecord, $pageLimit, $pageParam);

$query = $db->from('users')
    ->orderby('name, surname', 'ASC')
    ->limit($pagination['start'], $pagination['limit'])
    ->all();

require admin_view('employees');