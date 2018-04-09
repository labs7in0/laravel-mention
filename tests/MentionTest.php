<?php

namespace Tests;

use Labs7in0\Mention\Parser;

class MentionTest extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        return $app;
    }

    public function testTrue()
    {
        $this->assertTrue(true);
    }

    public function testInstance()
    {
        $parser = new Parser();
        $this->assertInstanceOf(Parser::class, $parser);
    }
}
