<?php
if(!route(1)){
    $route[1] = 'index';
}

if (!file_exists((manager_controller(route(1))))) {
    $route[1] = '404';
}

$manager_menus = [
    'index' => [
        'title' => 'Ana Ekran',
        'icon' => 'th-large'
    ],
    'leave' => [
        'title' => 'İzin',
        'icon' => 'tasks',
        'submenu'=>[
            'my-leaves'=>'İzinlerim',
            'leave-requests'=>'İzin Talepleri',
            'request_leave' => 'İzin Talebi Oluşturma'

        ]
    ],
    'report'=>[
        'title'=>'Rapor',
        'icon'=>'sticky-note'
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

require manager_controller(route(1));