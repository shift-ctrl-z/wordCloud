<?php

namespace WordCloud;

class FileGenerator
{
    const PROJECT_ROOT_PATH = 'codebase-wording-export.txt';

    public function generateWordsFile(array $words, $exportFilePath = self::PROJECT_ROOT_PATH)
    {
        file_put_contents($exportFilePath, implode(' ', $words));
    }
}