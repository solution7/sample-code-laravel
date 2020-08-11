<?php

namespace App\Traits;

trait DBForeignKey
{
    private function disableForeignKeyCheck()
    {
        $connection = config('database.connections')[config('database.default')];
        $sql='';
        switch ($connection['driver']) {
            case 'mysql':
                $sql='SET FOREIGN_KEY_CHECKS = 0';
                break;
            case 'sqlite':
                $sql='PRAGMA foreign_keys = OFF';
                break;
        }

        \DB::statement($sql);
    }
  
    private function enableForeignKeyCheck()
    {
        $connection = config('database.connections')[config('database.default')];
        $sql='';
        switch ($connection['driver']) {
            case 'mysql':
                $sql='SET FOREIGN_KEY_CHECKS = 1';
                break;
            case 'sqlite':
                $sql='PRAGMA foreign_keys = ON';
                break;
        }

        \DB::statement($sql);
    }
}
