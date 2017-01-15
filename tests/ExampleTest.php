<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \PHPUnit_Framework_TestCase as TestCase;

final class ExampleTest extends TestCase
{
    /**
     * @test
     * @expectedSuccess
     */
    public function testIfBasePathIsDefined()
    {
        $this->assertTrue(defined('BASEPATH'));
    }


    // ...

}
