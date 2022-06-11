<?php

namespace App\HostingStrategy\Strategy;

interface HostingInterface
{
    public function handle($input) :string;
}