<?php

namespace Test\WordCloud;

use PHPUnit\Framework\TestCase;
use WordCloud\CloudGenerator;

class CloudGeneratorTest extends TestCase
{
    const EXPECTED = [
        'WordCloud' => 1,
        'directory' => 2,
        'iterator' => 2,
        'regex' => 2,
        'sourceFiles' => 3,
        'file' => 2,
        'names' => 4,
        'filePath' => 2,
        'sourceCode' => 3,
        'word' => 4,
        'content' => 4,
        'namespaces' => 3,
        'domain' => 4,
        'namespace' => 2,
        'CloudGenerator' => 1,
        'VARIABLE_NAME' => 1,
        'CLASS_NAME' => 1,
        'CONST_NAME' => 1,
        'INTERFACE_NAME' => 1,
        'TRAIT_NAME' => 1,
        'METHOD_NAME' => 1,
        'METHOD_CALL' => 1,
        'STATIC_CLASS_NAME' => 1,
        'STATIC_CLASS_METHOD' => 1,
        'PROPERTY_NAME' => 1,
        'ARRAY_KEY_DOUBLE_QUOTES' => 1,
        'ARRAY_KEY_SIMPLE_QUOTES' => 1,
        'EXTRACT_NAMING_REGEX' => 1,
        'codeBaseDirectoryPath' => 4,
        'words' => 4,
        'wordingScores' => 5,
        'files' => 2,
        'match' => 3,
    ];

    /**
     * @test
     */
    public function generateNameScoreFromDirectory()
    {
        $generator = new CloudGenerator();
        $nameScores = $generator->generateWordingScoresFrom(__DIR__ . '/../src');
        $this->assertEquals(self::EXPECTED, $nameScores);
    }
}
