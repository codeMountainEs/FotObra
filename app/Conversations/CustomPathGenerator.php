<?php
namespace App\Conversations;


use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

abstract class CustomPathGenerator implements  PathGenerator{
    public function getPath(Media $media): string
    {
        return 'obras/'.$media->id .'/'. $media->file_name;
    }

    public function getPathForConversions(Media $media): string
    {
        return 'obras/'.$media->id .'/'. $media->file_name;
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return 'obras/'.$media->id .'/'. $media->file_name;
    }
}
