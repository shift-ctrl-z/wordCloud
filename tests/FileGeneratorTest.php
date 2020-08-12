<?php

namespace Test\WordCloud;

use PHPUnit\Framework\TestCase;
use WordCloud\FileGenerator;

class FileGeneratorTest extends TestCase
{
    /**
     * @test
     */
    public function displayWords(){
        $fileGenerator = new FileGenerator();
        $fileGenerator->exportWords(['word2','word1'],__DIR__.'test-codebase-words-export.txt');
        $this->assertFileEquals(__DIR__.'test-codebase-words-export.txt',__DIR__.'/Dataset/expected-test-codebase-words-export.txt');
    }
}
