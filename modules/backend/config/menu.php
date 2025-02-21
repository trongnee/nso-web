<?php
return [
    [
        'label' => 'Trang Chủ',
        'route' => 'dashboard',
        'icon' => 'ti-smart-home',
    ],
    
    [
        'label' => 'Các Giao Dịch',
        'icon' => 'ti-file-dollar',
        'children' => [
            [
                'label' => 'Nạp ATM',
                'icon' => 'ti-users',
                'route' => 'login',
            ],
            [
                'label' => 'Nạp Thẻ Cào',
                'icon' => 'ti-users',
                'route' => 'login',
            ],
            [
                'label' => 'Biến Động Số Dư',
                'icon' => 'ti-file-dollar',
                'route' => 'login',
            ],
        ]
    ],

    [
        'label' => 'Tài Khoản',
        'icon' => 'ti-users',
        'children' => [
            [
                'label' => 'Tài Khoản',
                'icon' => 'ti-users',
                'route' => 'users',
            ],
            [
                'label' => 'Nhân Vật Trong Game',
                'icon' => 'ti-users',
                'route' => 'players',
            ],
        ]
    ],
    [
        'label' => 'Quyền & Vai Trò',
        'icon' => 'ti-settings',
        'children' => [
            [
                'label' => 'Quyền',
                'icon' => 'ti-settings',
                'route' => 'login',
            ],
            [
                'label' => 'Vai trò',
                'icon' => 'ti-users',
                'route' => 'login',
            ],
        ]
    ],
    [
        'label' => 'Cấu Hình',
        'icon' => 'ti-toggle-left',
        'children' => [
            [
                'label' => 'Mã Quà Tặng',
                'icon' => 'ti-toggle-left',
                'route' => 'login',
            ],
            [
                'label' => 'Các Vật Phẩm',
                'icon' => 'ti-toggle-left',
                'route' => 'login',
            ],
            [
                'label' => 'Các Chiêu Thức',
                'icon' => 'ti-toggle-left',
                'route' => 'login',
            ],
            [
                'label' => 'Cửa Hàng Goosho',
                'icon' => 'ti-toggle-left',
                'route' => 'login',
            ],
            [
                'label' => 'Quái Vật Trong Game',
                'icon' => 'ti-toggle-left',
                'route' => 'login',
            ],
            [
                'label' => 'Gia Tộc',
                'icon' => 'ti-toggle-left',
                'route' => 'login',
            ],
        ]
    ],
    
];
