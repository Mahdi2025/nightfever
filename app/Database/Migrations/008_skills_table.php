<?php

return [
    'table_name' => 'skills',

    'drop_scheme' => "SET FOREIGN_KEY_CHECKS = 0; DROP TABLE IF EXISTS `skills`; SET FOREIGN_KEY_CHECKS = 1",

    'scheme' => "CREATE TABLE IF NOT EXISTS `skills` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int NOT NULL,
        `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        `info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
        `created` timestamp NOT NULL,
        `updated` timestamp DEFAULT CURRENT_TIMESTAMP,
        `deleted` timestamp DEFAULT NULL,
        `created_by` int(11) NOT NULL,
        `updated_by` int(11),
        `deleted_by` int(11),
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",

    'relations' => [
        'ALTER TABLE `skills` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
        'ALTER TABLE `skills` ADD FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
        'ALTER TABLE `skills` ADD FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
        'ALTER TABLE `skills` ADD FOREIGN KEY (`deleted_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
    ],

    'seeder' => [
        'type' => 'array',
        'data' => array([
            'user_id'      => 1,
            'name'         => 'PHP',
            'created'      => date('Y-m-d H:i:s'),
            'created_by'   => 1,
        ],

        [
            'user_id'      => 1,
            'name'         => 'MySQL',
            'created'      => date('Y-m-d H:i:s'),
            'created_by'   => 1,
        ],
        
        [
            'user_id'      => 2,
            'name'         => 'NodeJS',
            'created'      => date('Y-m-d H:i:s'),
            'created_by'   => 1,
        ],
        
        [
            'user_id'      => 2,
            'name'         => 'Javascript',
            'created'      => date('Y-m-d H:i:s'),
            'created_by'   => 1,
        ]),
    ],
];
