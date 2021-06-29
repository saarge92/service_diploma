<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\FileServiceInterface;
use Illuminate\Http\UploadedFile;

class FileService implements FileServiceInterface
{

    public function saveFile(UploadedFile $file, string $destination, ?string $name = null): string
    {
        $filename = $name ? $name . '_' . date('Y_m_d H_i_s') : date('Y_m_d H_i_s');
        $filename = $filename . '.' . $file->getClientOriginalExtension();
        $fullDestination = public_path() . '/storage/' . $destination . '/';
        $file->move($fullDestination, $filename);
        return $destination . '/' . $filename;
    }
}
