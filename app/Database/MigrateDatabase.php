<?php

namespace App\Database;

use App\Libraries\MySql;

/**
 * Check for files which holds database queries to create scheme's
 * @param $dropTable (default = false) set to true to drop all tables and create it again
 */

class MigrateDatabase
{
    protected static $dropTable;

    protected static $seed;

    public static function migrate($dropTable, $seed)
    {
        self::$dropTable = $dropTable;
        self::$seed = $seed;

        self::start();
    }
    
    private static function start()
    {
        // get files from current directory
        $files = scandir(__DIR__ . "/Migrations/", SCANDIR_SORT_ASCENDING);
        
        $file = fopen('.migration', 'w');

        if (count($files) >= 1)
        {
            foreach ($files as $file)
            {
                // skip files that doesn't represent migration data
                if (trim(strtolower($file)) !== 'migrate.php' && $file !== '.' && $file !== '..')
                { 
                    $migrationData = require_once __DIR__ . "/Migrations/" . $file;

                    if (self::$dropTable)
                    {
                        MySql::query($migrationData['drop_scheme']);
                    }
                    
                    // Add the scheme
                    MySql::query($migrationData['scheme']);

                    // Add relations (if any)
                    if (isset($migrationData['relations'])) {
                        foreach ($migrationData['relations'] as $relation)
                        {
                            MySql::query($relation);
                        }
                    }

                    // Is there any data to seed?
                    if (self::$seed && isset($migrationData['seeder']))
                    {
                        if ($migrationData['seeder']['type'] == 'array')
                        {
                            foreach ($migrationData['seeder']['data'] as $seed)
                            {
                                MySql::insert($seed, $migrationData['table_name']);
                            }
                        }
                        else if ($migrationData['seeder']['type'] == 'sql')
                        {
                            MySql::query($migrationData['seeder']['data']);
                        }
                    }
                }
            }
        }
    }

}