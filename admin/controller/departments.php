<?php
try {
    $db = new BasicDB('localhost','meritdesk','root', '');

}catch(PDOException $e){
    die($e->getMessage());
}
$totalRecord = $db-> from('departments')
    ->select('count(id) as total')
    ->total();

$pageLimit = 10;
$pageParam = 'page';
$pagination = $db->pagination($totalRecord, $pageLimit, $pageParam);

$query = $db->from('departments')
    ->orderby('id', 'ASC')
    ->limit($pagination['start'], $pagination['limit'])
    ->all();

require admin_view('departments');