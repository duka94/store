<?php

namespace Tests\Fakes;


use Illuminate\Http\UploadedFile;

class FileFake
{
    public static function file()
    {
        $image = (base_path('tests/Fakes/assets/signature.png'));

        return UploadedFile::fake()->image($image);
    }
}
