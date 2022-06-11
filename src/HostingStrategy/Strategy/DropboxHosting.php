<?php

namespace App\HostingStrategy\Strategy;

use Spatie\Dropbox\Client;

class DropboxHosting implements HostingInterface
{
    const AUTH_TOKEN = 'sl.BJUCgKmpM5jjT6Mhw2aNFpnAZFRX42274DIu3hXaAAvEngLwjBtag7O0L3VBoO--Pho7p1FxS-h8vopf9MgtUDYJZIgJbLows8FQi4tav7abkMi9Y3RGuUytcPqqMcTlJ7dBnEY';

    public function handle($input) :string
    {
        $this->upload($input);
        return 'Dropbox';
    }

    private function upload($input)
    {
        $img = readfile('Images/1654976921.jpg');
        $client = new Client(DropboxHosting::AUTH_TOKEN);
        $name = (string)time() . '.jpg';
        $client->upload('/IMG/' . $name, $img, $mode='add');
    }
}