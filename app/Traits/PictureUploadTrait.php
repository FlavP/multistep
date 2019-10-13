<?php


namespace App\Traits;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait PictureUploadTrait
{
    public function uploadPicture(UploadedFile $uploadedFile, $folder = null, $filename = null, $disk = 'public')
    {
        if ($folder === null)
            //Define folder path if folder is not set
            $folder = config('constants.UPLOAD_PICTURE_DIRECTORY');
        $file = $uploadedFile->storeAs($folder, $filename . '.' . $uploadedFile->getClientOriginalExtension(), $disk);
        return $file;
    }

    public function deletePicture($folder, $filename, $disk = 'public')
    {
        if ($folder === null)
            // Define folder path if folder is not set
            $folder = config('constants.UPLOAD_PICTURE_DIRECTORY');
        Storage::disk($disk)->delete($folder . $filename);
    }

    public function getPicture($folder, $filename, $disk = 'public')
    {
        if ($folder === null)
            // Define folder path if folder is not set
            $folder = config('constants.UPLOAD_PICTURE_DIRECTORY');
        if ($filename === null)
            // Return a 404 image if the user does not have an image
            $filename = config('constants.IMAGE_404');
        if (Storage::disk($disk)->exists($folder . $filename))
            return Storage::disk($disk)->url($folder . $filename);
        return false;
    }
}
