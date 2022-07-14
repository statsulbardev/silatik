<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait GoogleDriveTrait
{
    private $disk = 'google';

    public function uploadFile(string $folderId, string $stage, $file)
    {
        switch($stage)
        {
            case 'create' :
                if (is_array($file)) {
                    $folderName = Str::random(5);

                    // Create Sub Directory By Given Date
                    Storage::disk($this->disk)->makeDirectory($folderId . '/' . $folderName);

                    $folderId = collect(Storage::disk($this->disk)->listContents($folderId, false))->where('name', $folderName)->first();

                    foreach ($file as $item) $item['url']->storeAs($folderId['basename'], Str::random(5) . '-' . $item['url']->getClientOriginalName(), $this->disk);

                    $contents = collect(Storage::disk($this->disk)->listContents($folderId['basename'], false));

                    return collect([
                        'folderId' => $folderId['basename'],
                        'contents' => $contents->pluck('basename')
                    ]);
                } else {
                    $filename = Str::random(5) . '_' . $file->getClientOriginalName();

                    if (!is_null($file)) $file->storeAs($folderId, $filename, $this->disk);

                    $contents = collect(Storage::disk($this->disk)->listContents($folderId, false))->where('name', $filename)->first();

                    $file = $contents['basename'];

                    return $file;
                }

                break;
            case 'update' :
                if (is_array($file)) {
                    foreach ($file as $item) $item['url']->storeAs($folderId, Str::random(5) . '_' . $item['url']->getClientOriginalName(), $this->disk);

                    $contents = collect(Storage::disk($this->disk)->listContents($folderId, false));

                    return $contents->pluck('basename');
                } else {
                    $filename = Str::random(5) . '-' . $file->getClientOriginalName();

                    if (!is_null($file)) $file->storeAs($folderId, $filename, $this->disk);

                    $contents = collect(Storage::disk($this->disk)->listContents($folderId, false))->where('name', $filename)->first();

                    $file = $contents['basename'];

                    return $file;
                }

                break;
        }
    }

    public function createDirectory($model) : array
    {
        Storage::disk('google')->makeDirectory(env('GOOGLE_DRIVE_FOLDER_GALERI') . '/' . Str::random(8));

        $arrCompare = $model::where('gallery_id', 1)->pluck('file')->toArray();

        return array_values(array_diff(Storage::disk($this->disk)->directories(env('GOOGLE_DRIVE_FOLDER_GALERI')), $arrCompare));
    }

    public function deleteDirectory(string $directoryId) : void
    {
        Storage::disk($this->disk)->deleteDirectory($directoryId);
    }

    public function deleteFile(string $fileId) : void
    {
        Storage::disk($this->disk)->delete($fileId);
    }
}
