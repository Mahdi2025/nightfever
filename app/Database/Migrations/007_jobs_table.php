<?php

return [
    'table_name' => 'jobs',

    'drop_scheme' => "SET FOREIGN_KEY_CHECKS = 0; DROP TABLE IF EXISTS `jobs`; SET FOREIGN_KEY_CHECKS = 1",

    'scheme' => "CREATE TABLE IF NOT EXISTS `jobs` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int NOT NULL,
        `start_year` year NOT NULL,
        `end_year` year DEFAULT NULL,
        `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        `info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
        `created` timestamp NOT NULL,
        `updated` timestamp DEFAULT CURRENT_TIMESTAMP,
        `deleted` timestamp DEFAULT NULL,
        `created_by` int(11) NOT NULL,
        `updated_by` int(11),
        `deleted_by` int(11),
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;",

    'relations' => [
        'ALTER TABLE `jobs` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
        'ALTER TABLE `jobs` ADD FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
        'ALTER TABLE `jobs` ADD FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
        'ALTER TABLE `jobs` ADD FOREIGN KEY (`deleted_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;',
    ],

    'seeder' => [
        'type' => 'array',
        'data' => array([
            'user_id'      => 1,
            'start_year'   => 2012,
            'end_year'     => 2014,
            'name'         => 'Vrijwilligerswerk',
            'info'         => 'Bij Kat in Nood',
            'created'      => date('Y-m-d H:i:s'),
            'created_by'   => 1,
        ],

        [
            'user_id'      => 1,
            'start_year'   => 2015,
            'end_year'     => 2017,
            'name'         => 'Administratief werk',
            'info'         => 'Bij DUO',
            'created'      => date('Y-m-d H:i:s'),
            'created_by'   => 1,
        ],
        
        [
            'user_id'      => 2,
            'start_year'   => 2019,
            'end_year'     => 2020,
            'name'         => 'Vrijwilligerswerk',
            'info'         => 'Bij Forumbibliotheek',
            'created'      => date('Y-m-d H:i:s'),
            'created_by'   => 1,
        ],
        
        [
            'user_id'      => 2,
            'start_year'   => 2020,
            'end_year'     => 2021,
            'name'         => 'Web Development',
            'info'         => 'Junior web developer',
            'created'      => date('Y-m-d H:i:s'),
            'created_by'   => 1,
        ]),
    ],
];
