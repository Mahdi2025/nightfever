<?php

return [
    'table_name' => 'roles',

    'drop_scheme' => "SET FOREIGN_KEY_CHECKS =0; DROP TABLE IF EXISTS `roles`; SET FOREIGN_KEY_CHECKS = 1;",

    'scheme' => "CREATE TABLE IF NOT EXISTS `roles` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(80) NOT NULL,
        `created` timestamp NOT NULL,
        `updated` timestamp DEFAULT CURRENT_TIMESTAMP,
        `deleted` timestamp DEFAULT NULL,
        `created_by` int(11) NOT NULL,
        `updated_by` int(11),
        `deleted_by` int(11),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;",

    'relations' => [
        'ALTER TABLE `roles` ADD FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
        'ALTER TABLE `roles` ADD FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
        'ALTER TABLE `roles` ADD FOREIGN KEY (`deleted_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
    ],

    'seeder' => [
        'type' => 'array',
        'data' => array(
            [
                'name'       => 'super-admin',
                'created'    => date('Y-m-d H:i:s'),
                'created_by' => 1
            ],

            [
                'name'       => 'admin',
                'created'    => date('Y-m-d H:i:s'),
                'created_by' => 1
            ],

            [
                'name'       => 'user',
                'created'    => date('Y-m-d H:i:s'),
                'created_by' => 1
            ]
        ),
    ],
];
