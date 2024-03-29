<?php

namespace CPTools\Transformer;

/**
 * Test class for Transformer.
 * Generated by PHPUnit on 2013-09-25 at 14:50:32.
 */
class RemoveKeyLevelTransformerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Transformer
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Transformer(array(
            'test'  => 'test1',
            'test2' => 'test2',
            'test3' => 'test3',
            'array' => array(
                'test' => 'one',
                'test2' => 'two',
                'test3' => 'three'
            )
        ));
    }

    /**
     * Test Move Key From 1 Level Down Transform
     */
    public function testTransform() {
        
        
        $lrRTransformer = new Transformers\RemoveKeyLevelTransformer('array', 'test');
        $this->object->addTransformer($lrRTransformer);
        $ltResult = $this->object->transform();
        
        $this->assertFalse(array_key_exists('test', $ltResult['array']));
        $this->assertTrue(array_key_exists('test', $ltResult));
        $this->assertEquals(2, count($ltResult['array']));
    }
}
