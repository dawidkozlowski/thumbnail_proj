<?php

namespace App\HostingStrategy\Strategy;

class BucketSHosting implements HostingInterface
{

    public function handle($input) :string
    {
        // TODO: Implement upload() method.
        return 'Bucket';
    }
}