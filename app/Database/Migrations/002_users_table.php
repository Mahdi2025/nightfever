<?php

return [
    'table_name' => 'users',

    'drop_scheme' => "SET FOREIGN_KEY_CHECKS = 0; DROP TABLE IF EXISTS `users`; SET FOREIGN_KEY_CHECKS = 1",

    'scheme' => "CREATE TABLE IF NOT EXISTS `users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `role`int(11) NOT NULL,
        `first_name` varchar(80) NOT NULL,
        `insertion` varchar(20),
        `last_name` varchar(80) NOT NULL,
        `email` varchar(255) NOT NULL,
        `password` varchar(255) NOT NULL,
        `country` int(11),
        `city` varchar(255),
        `birthday` date,
        `created` timestamp,
        `updated` timestamp DEFAULT CURRENT_TIMESTAMP,
        `deleted` timestamp DEFAULT NULL,
        `created_by` int(11) NOT NULL,
        `updated_by` int(11),
        `deleted_by` int(11),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;",

    'relations' => [
        'ALTER TABLE `users` ADD FOREIGN KEY (`role`) REFERENCES `roles`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
        'ALTER TABLE `users` ADD FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
        'ALTER TABLE `users` ADD FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
        'ALTER TABLE `users` ADD FOREIGN KEY (`deleted_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
        'ALTER TABLE `new-cv`.`users` ADD UNIQUE `email` (`email`);',
    ],

    'seeder' => [
        'type' => 'array',
        'data' => array([
            'first_name' => 'Donald',
            'last_name'  => 'Duck',
            'email'      => 'donald@codegorilla.nl',
            'password'   => password_hash('Gorilla1!', PASSWORD_DEFAULT),
            'role'       => 3,
            'country'    => 156,
            'city'       => 'Duckstad',
            'birthday'   => '1956-05-19',
            'created'    => date('Y-m-d H:i:s'),
            'created_by' => 1,
        ],
        
        [
            'first_name' => 'Pietje',
            'last_name'  => 'Puk',
            'email'      => 'ppuk@codegorilla.nl',
            'password'   => password_hash('Gorilla1!', PASSWORD_DEFAULT),
            'role'       => 2,
            'country'    => 156,
            'city'       => 'Groningen',
            'birthday'   => '1996-03-19',
            'created'    => date('Y-m-d H:i:s'),
            'created_by' => 1,
        ],

        [
            'first_name' => 'Micky',
            'last_name'  => 'Mouse',
            'email'      => 'mm@codegorilla.nl',
            'password'   => password_hash('Gorilla1!', PASSWORD_DEFAULT),
            'role'       => 1,
            'country'    => 156,
            'city'       => 'Groningen',
            'birthday'   => '1996-03-19',
            'created'    => date('Y-m-d H:i:s'),
            'created_by' => 1,
        ]),
    ],
];
