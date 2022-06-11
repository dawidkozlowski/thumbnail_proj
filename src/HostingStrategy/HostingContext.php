<?php

namespace App\HostingStrategy;

use App\HostingStrategy\Strategy\HostingInterface;

class HostingContext
{
    private HostingInterface $hosting;

    public function __construct(HostingInterface $hosting)
    {
        $this->hosting = $hosting;
    }

    public function handle($data) :string
    {
        return $this->hosting->handle($data);
    }
}