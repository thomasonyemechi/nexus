<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class BackupController extends Controller
{
    function exportDatabaseAndSendEmail()
    {
        $databaseName = env('DB_DATABASE');
        $recipientEmail = 'jaspergab94@gmail.com';


        $tables = DB::select('SHOW TABLES');
        $sqlDump = '';

        foreach ($tables as $table) {
            $tableName = array_values((array)$table)[0];
            $createTable = DB::select("SHOW CREATE TABLE `$tableName`")[0]->{'Create Table'} . ";\n\n";
            $sqlDump .= $createTable;

            $rows = DB::select("SELECT * FROM `$tableName`");
            foreach ($rows as $row) {
                $values = array_map(fn($value) => "'" . addslashes($value) . "'", (array) $row);
                $sqlDump .= "INSERT INTO `$tableName` VALUES (" . implode(", ", $values) . ");\n";
            }
            $sqlDump .= "\n";
        }

         if (!file_exists(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0777, true);
        }

        $backupFile = storage_path('app/backups/' . $databaseName . '_backup_' . date("Y-m-d_H-i-s") . '.sql');
        file_put_contents($backupFile, $sqlDump);

        if ($backupFile) {
            // Send email with attachment
            Mail::raw('Attached is the database backup.', function ($message) use ($backupFile, $recipientEmail) {
                $message->to($recipientEmail)
                    ->subject('Database Backup')
                    ->attach($backupFile);
            });
            return ;
        } else {
            return;
        }
    }


}
