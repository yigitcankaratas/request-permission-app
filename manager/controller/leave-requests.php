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
    ->where('m1', $mail)
    ->or_where('m2', $mail)
    ->or_where('m3', $mail)
    ->or_where('m4', $mail)
    ->orderby('id', 'DESC')
    ->limit($pagination['start'], $pagination['limit'])
    ->all();

require manager_view('leave-requests');
