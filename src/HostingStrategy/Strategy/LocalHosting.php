<?php

namespace App\HostingStrategy\Strategy;

class LocalHosting implements HostingInterface
{
    public function handle(mixed $input) :string
    {
        $destdir = 'Images/';
        $name = (string)time() . '.jpg';
        imagejpeg($input, $destdir . $name, 100);
        return $destdir . $name;
    }
}