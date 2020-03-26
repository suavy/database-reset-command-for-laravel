<?php

namespace Suavy\DatabaseResetCommandForLaravel\Tests;

use Orchestra\Testbench\TestCase;
use Suavy\DatabaseResetCommandForLaravel\DatabaseResetCommandForLaravelServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [DatabaseResetCommandForLaravelServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
