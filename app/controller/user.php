<?php
if(!route(1)){
    $route[1] = 'index';
}
if (!file_exists((user_controller(route(1))))) {
    $route[1] = '404';
}

$user_menus = [
    'index' => [
        'title' => 'Ana Ekran',
        'icon' => 'th-large'
    ],
    'leave' => [
        'title' => 'İzin',
        'icon' => 'tasks',
        'submenu'=>[
            'my-leaves'=>'İzinlerim',
            'leave-requests'=>'İzin Talebi Oluşturma',

        ]
    ],
    'calender'=>[
        'title'=>'Takvim',
        'icon'=>'table'
    ],
    'account'=>[
        'title'=>'Hesabım',
        'icon'=>'male'
    ]
];


require user_controller(route(1));