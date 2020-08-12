<?php

namespace Test\WordCloud;

use PHPUnit\Framework\TestCase;
use WordCloud\CloudGenerator;

class CloudGeneratorTest extends TestCase
{
    const EXPECTED = [
        'Test' => 1,
        'Dataset' => 1,
        'ClassExample' => 1,
        'InstanceClassName' => 1,
        'STRING_CONSTANT_NAME_FIRST_EXAMPLE' => 1,
        'STRING_CONSTANT_NAME_SECOND_EXAMPLE' => 1,
        'ARRAY_CONSTANT_NAME_EXAMPLE' => 1,
        'WordCloud' => 1,
        'stringArgument' => 1,
        'integerArgument' => 1,
        'arrayArgument' => 1,
        'stringVariable' => 1,
        'integerVariable' => 1,
        'foreachIndex' => 2,
        'foreachElement' => 6,
        'arrayVariable' => 3,
    ];

    /**
     * @test
     */
    public function generateNameScoreFromDirectory()
    {
        $generator = new CloudGenerator();
        $nameScores = $generator->generateWordingScoresFrom(__DIR__ . '/Dataset');
        $this->assertEquals(self::EXPECTED, $nameScores);
    }
}
