<?php

namespace App\HostingStrategy\Strategy;

class BucketHosting implements HostingInterface
{

    public function handle($input) :string
    {
        return 'Bucket';
    }
}