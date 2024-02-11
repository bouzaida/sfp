<?php

namespace App\TwigExtension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MyCustomTwigExtensions extends AbstractExtension
{
public function getFilters()
{
    return [
            new TwigFilter('defaultImage', [$this, 'defaultImage'])
    ];
}
    public function defaultImage(string $path): string{
    if(strlen(trim($path)) == 0) {
        return 'souheil.jpg';
    }
    return $path;
    }

}