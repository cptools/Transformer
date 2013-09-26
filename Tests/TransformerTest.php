<?php

namespace CPTools\Transformer;

/**
 * Test class for Transformer.
 * Generated by PHPUnit on 2013-09-25 at 14:50:32.
 */
class TransformerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Container
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Transformer(array(
            'test' => 'test1',
            'test2' => 'test2',
            'test3' => 'test3'
        ));
    }

    /**
     */
    public function testTransform() {
        $this->object->addTransformer(new Transformers\RemoveKeyTransformer('test3'));
        $this->assertFalse(array_key_exists('test3', $this->object->transform()));
    }

    public function testComplexTransform() {
        $this->object->addTransformer(new Transformers\ConcatTransformer(array('test', 'test2', 'test3'), 'result', '|'));
        $this->object->addTransformer(new Transformers\RemoveKeyTransformer('test'));
        $this->object->addTransformer(new Transformers\RemoveKeyTransformer('test2'));
        $this->object->addTransformer(new Transformers\RemoveKeyTransformer('test3'));

        $result = $this->object->transform();

        $this->assertFalse(array_key_exists('test3', $result));
        $this->assertEquals(1, count($result));
        $this->assertTrue(array_key_exists('result', $result));
        $this->assertEquals('test1|test2|test3', $result['result']);
    }

}
