<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

interface FileServiceInterface
{
    public function saveFile(UploadedFile $file, string $destination): string;
}
