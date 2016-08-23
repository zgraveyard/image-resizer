<?php namespace Resizer\Classes;

use Illuminate\Config\Repository;
use Illuminate\Support\Collection;
use Intervention\Image\ImageManager;
use Resizer\Contracts\ResizeInterface;

class Resize implements ResizeInterface
{

    public function resizeImage($imageURL)
    {
        $config = $this->getConfig();
        $images['images'] = [];
        $config->each(function($size) use($imageURL, &$images){
            $images['images']['image_'.$size[0]] =$this->resize($imageURL, $size, pathinfo($imageURL)['filename']);
        });

        return $images;
    }

    private function getConfig()
    {
        $configPath = __DIR__ .'/../../config/';
        $config = new Repository(require $configPath . 'images.php');

        return Collection::make($config->get('resize'));
    }

    private function resize($image, array $dimensions, $directory)
    {
        if(!is_dir(__DIR__.'/../../public/'.$directory))
            @mkdir(__DIR__.'/../../public/'.$directory);

        $path = __DIR__.'/../../public/'.$directory .'/image_'.$dimensions[0].'_'.basename($image);
        $manager = new ImageManager(['driver' => env('RESIZE_ENGINE','gd')]);
        $manager->make($image)
            ->resize($dimensions[0], $dimensions[1], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->save($path);
        return '/public/'.$directory .'/image_'.$dimensions[0].'_'.basename($image);
    }
}