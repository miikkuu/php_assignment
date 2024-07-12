<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class DatabaseService
{
    private $dbUser;
    private $dbPassword;
    private $dbName;

    public function __construct(string $dbUser, string $dbPassword, string $dbName)
    {
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
        $this->dbName = $dbName;
    }

    public function backup(): array
    {
        $backupFile = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $command = "mysqldump -u {$this->dbUser} -p{$this->dbPassword} {$this->dbName} > {$backupFile}";
        exec($command);

        return ['message' => 'Database backup created', 'file' => $backupFile];
    }

    public function restore(UploadedFile $file): array
    {
        $command = "mysql -u {$this->dbUser} -p{$this->dbPassword} {$this->dbName} < {$file->getPathname()}";
        exec($command);

        return ['message' => 'Database restored successfully'];
    }
}