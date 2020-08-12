<?php

namespace Test\WordCloud;

use PHPUnit\Framework\TestCase;
use WordCloud\WordParser;

class WordParserTest extends TestCase
{
    const EXPECTED = [
        'Test',
        'WordCloud',
        'Dataset',
        'stringArgument',
        'integerArgument',
        'arrayArgument',
        'stringVariable',
        'integerVariable',
        'foreachIndex',
        'foreachElement',
        'foreachElement',
        'foreachIndex',
        'arrayVariable',
        'arrayVariable',
        'foreachElement',
        'foreachElement',
        'foreachElement',
        'foreachElement',
        'arrayVariable',
        'ClassExample',
        'InstanceClassName',
        'STRING_CONSTANT_NAME_FIRST_EXAMPLE',
        'STRING_CONSTANT_NAME_SECOND_EXAMPLE',
        'ARRAY_CONSTANT_NAME_EXAMPLE',
    ];

    /**
     * @test
     */
    public function extractWords()
    {
        $generator = new WordParser();
        $nameScores = $generator->extractWordsFrom(__DIR__ . '/Dataset');
        $this->assertEquals(self::EXPECTED, $nameScores);
    }
}
