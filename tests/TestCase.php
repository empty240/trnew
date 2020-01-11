<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $trDomain;

    public function setUp(): void
    {
        parent::setUp();
        $this->trDomain = 'https://'.config('const.env.tr_domain');
    }
}
