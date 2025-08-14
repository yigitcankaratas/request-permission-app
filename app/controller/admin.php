<?php
if(!route(1)){
    $route[1] = 'index';
}

if (!file_exists((admin_controller(route(1))))) {
    $route[1] = '404';
}

$admin_menus = [
    'index' => [
        'title' => 'Ana Ekran',
        'icon' => 'th-large'
    ],
    'leave' => [
        'title' => 'İzin',
        'icon' => 'tasks',
        'submenu'=>[
            'leave-requests'=>'İzin Talepleri',
            'collective-leaves'=>'Toplu İzin Tanımlama'

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
    'hr'=>[
        'title'=>'İnsan Kaynakları',
        'icon'=>'user',
        'submenu'=>[
            'employees' => 'Çalışanlar',
            'add-user'=>'Çalışan Ekle',
            'departments'=>'Departmanlar',
            'add-department'=>'Departman Ekle',
            'companies'=>'Şirketler',
            'add-company'=>'Şirket Ekle'

        ]
    ],
    'account'=>[
        'title'=>'Hesabım',
        'icon'=>'male'
    ],
    'settings'=>[
        'title'=>'Ayarlar',
        'icon'=>'cog'
    ]
];

require admin_controller(route(1));