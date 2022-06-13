<?php

namespace App\HostingStrategy\Strategy;

class DropboxHosting implements HostingInterface
{
    public function handle($input) :string
    {
        return 'Dropbox';
    }
}