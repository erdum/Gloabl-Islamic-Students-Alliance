<?php

function save_img_to_webp(
    $image,
    $file_directory,
    $file_name = null,
    $disk_driver = 'local'
)
{
    $file_name = $file_name ?? Str::random(15);
    $file_path = "{$file_directory}{$file_name}.webp";
    $extension = $image->getClientOriginalExtension();
    $decoded_image = null;

    if ($extension == 'webp') {
        $decoded_image = imagecreatefromwebp($image);
    } elseif ($extension == 'jpeg' || $extension == 'jpg') {
        $decoded_image = imagecreatefromjpeg($image);
    } elseif ($extension == 'gif') {
        $decoded_image = imagecreatefromgif($image);
    } elseif ($extension == 'png') {
        $decoded_image = imagecreatefrompng($image);
    }
    
    if ($decoded_image == null)
        return redirect()->back()->withErrors([
            'file' => 'File mime-type not supported!'
        ])->withInput();

    $handle = fopen("php://memory", "rw");
    imagepalettetotruecolor($decoded_image);
    imagewebp($decoded_image, $handle, 75);
    imagedestroy($decoded_image);
    Storage::disk($disk_driver)->put($file_path, $handle);
    fclose($handle);

    return $file_path;
}