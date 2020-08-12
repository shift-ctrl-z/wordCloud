<?php

namespace Test\WordCloud;

use PHPUnit\Framework\TestCase;
use WordCloud\CloudGenerator;

class CloudGeneratorTest extends TestCase
{
    const EXPECTED = [
        "WordCloud" => 1,
        "codeBaseDirectorypath" => 2,
        "directory" => 2,
        "iterator" => 2,
        "regex" => 4,
        "sourceFiles" => 3,
        "file" => 2,
        "names" => 9,
        "filePath" => 2,
        "sourceCode" => 3,
        "scoreNames" => 5,
        "name" => 4,
        "content" => 6,
        "namespaces" => 4,
        "domain" => 4,
        "namespace" => 2,
        "matchs" => 4,
        "CloudGenerator" => 1,
        "VARIABLE_NAME" => 1,
        "CLASS_NAME" => 1,
        "CONST_NAME" => 1,
        "INTERFACE_NAME" => 1,
        "TRAIT_NAME" => 1,
        "METHOD_NAME" => 1,
        "METHOD_CALL" => 1,
        "STATIC_CLASS_NAME" => 1,
        "STATIC_CLASS_METHOD" => 1,
        "PROPERTY_NAME" => 1,
        "ARRAY_KEY_DOUBLE_QUOTES" => 1,
        "ARRAY_KEY_SIMPLE_QUOTES" => 1,
        "EXTRACT_NAMING_REGEX" => 1,
    ];

    /**
     * @test
     */
    public function generateCloud()
    {
        $generator = new CloudGenerator();
        $nameScores = $generator->extractNamesFromCodeBase(__DIR__ . '/../src');
        $this->assertEquals(self::EXPECTED, $nameScores);
    }
}
