<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'bsVersion' => '4.x', // this will set globally `bsVersion` to Bootstrap 4.x for all Krajee Extensions
    'hail812/yii2-adminlte3' => [
        'pluginMap' => [
            'icheck-bootstrap' => [
                'css' => 'icheck-bootstrap/icheck-bootstrap.min.css',
            ],
            'overlayScrollbars' => [
                'css' => 'overlayScrollbars/css/OverlayScrollbars.min.css',
                'js' => 'overlayScrollbars/js/jquery.overlayScrollbars.min.js',
            ],
            'pace' => [
                'css' => 'pace-progress/themes/red/pace-theme-corner-indicator.css',
                // 'css' => 'pace-progress/themes/pink/pace-theme-center-simple.css',
                'js' => 'pace-progress/pace.min.js'
            ],
            'popper' => [
                'js' => 'popper/umd/popper.min.js'
            ],
            'sweetalert2' => [
                'css' => 'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                'js' => 'sweetalert2/sweetalert2.min.js'
            ],
            'toastr' => [
                'css' => ['toastr/toastr.min.css'],
                'js' => ['toastr/toastr.min.js']
            ],
            'chart.js' => [
                'css' => 'chart.js/Chart.min.css',
                'js' => 'chart.js/Chart.min.js'
            ]
        ]
    ],
    'sql_details' => [
        'user' => 'root',
        'pass' => '',
        'db' => 'klinik',
        'host' => 'localhost'
    ]

];
