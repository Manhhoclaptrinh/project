<?php
return [
    'admin' => [
        'username' => 'admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
        'role' => 'admin'
    ],
    'student' => [
        'username' => 'student',
        'password' => password_hash('student123', PASSWORD_DEFAULT),
        'role' => 'user'
    ]
];
