<?php

use PHPUnit\Framework\TestCase;

class RoutePathTest extends TestCase {

    public function testIndexPreg() {
        $this->assertEquals('/^$/', (new \Routing\Path(''))->getPreg());
        $this->assertEquals('/^$/', (new \Routing\Path(' '))->getPreg());
        $this->assertEquals('/^$/', (new \Routing\Path('/'))->getPreg());
    }

    public function testSomePreg() {
        $this->assertEquals('/^foo$/', (new \Routing\Path('foo'))->getPreg());
        $this->assertEquals('/^foo$/', (new \Routing\Path(' foo '))->getPreg());
        $this->assertEquals('/^\/foo$/', (new \Routing\Path('/foo'))->getPreg());
        $this->assertEquals('/^\/foo\/bar$/', (new \Routing\Path('/foo/bar'))->getPreg());
        $this->assertEquals('/^\/foo\/bar\.xml$/', (new \Routing\Path('/foo/bar.xml'))->getPreg());
    }

    public function testSomeParams() {
        $this->assertEquals('/^foo\/(?P<bar>)$/', (new \Routing\Path('/foo/{bar:str}'))->getPreg());
    }



}