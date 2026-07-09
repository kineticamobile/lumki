<?php

namespace Tests;

use Kineticamobile\Lumki\LumkiServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [LumkiServiceProvider::class];
    }
}
