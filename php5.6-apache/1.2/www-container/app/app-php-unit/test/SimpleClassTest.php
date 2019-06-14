<?php


use App\SimpleClass;

class PrincipioTest extends PHPUnit_Framework_TestCase
{

    private $instance ;

    public function setUp() {
        $this->instance = new SimpleClass;
    }

    public function testSoma() {
        $this->assertEquals(3,$this->instance->soma(1,2));
    }

}