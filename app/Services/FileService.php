<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\FileServiceInterface;
use Illuminate\Http\UploadedFile;

class FileService implements FileServiceInterface
{

    public function saveFile(UploadedFile $file, string $destination): string
    {
        $filename = 'service' . '_' . date('Y_m_d H_i_s') . '.' . $file->getClientOriginalExtension();
        $destination = public_path() . '/storage/' . $destination . '/';
        $file->move($destination, $filename);
        return $destination . '/' . $filename;
    }
}
