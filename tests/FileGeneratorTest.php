<?php

namespace Test\WordCloud;

use PHPUnit\Framework\TestCase;
use WordCloud\FileGenerator;

class FileGeneratorTest extends TestCase
{
    const TEST_FILE_EXPORT_PATH = __DIR__ . '/test-codebase-words-export.txt';

    /**
     * @test
     */
    public function exportWordsToTextFile(): void
    {
        $fileGenerator = new FileGenerator();
        $fileGenerator->generateWordsFile(['word2', 'word1'], self::TEST_FILE_EXPORT_PATH);
        $this->assertFileEquals(self::TEST_FILE_EXPORT_PATH, __DIR__ . '/Dataset/expected-test-codebase-words-export.txt');
    }

    protected function tearDown(): void
    {
        unlink(self::TEST_FILE_EXPORT_PATH);
    }
}
