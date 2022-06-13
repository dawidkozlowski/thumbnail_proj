<?php

namespace App\HostingStrategy\Strategy;

use Spatie\Dropbox\Client;

class DropboxHosting implements HostingInterface
{
    public function handle($input) :string
    {
        return 'Dropbox';
    }
}