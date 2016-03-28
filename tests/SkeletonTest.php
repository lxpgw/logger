<?php

namespace light\skeleton;

class SkeletonTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $skeleton = new Skeleton();

        $this->assertTrue($skeleton->run());
    }
}
