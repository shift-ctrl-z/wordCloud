<?php

namespace WordCloud;

class CloudGenerator
{
    const VARIABLE_NAME = '/\$(?!.*this)(\w+)/';
    const CLASS_NAME = '/class\s+(\w+)/';
    const CLASS_INSTANCE_NAME = '/new\s+(\w+)\(.*\)\;/';
    const CONST_NAME = '/const\s+(\w+)/';
    const INTERFACE_NAME = '/interface\s+(\w+)/';
    const TRAIT_NAME = '/trait\s+(\w+)/';
    const METHOD_NAME = '/\w+\s+function\s+^(?!.*(?:__construct|__invoke|__toString))(\w+)\(/';
    const METHOD_CALL = '/\-\>^(?!.*(?:__construct|__invoke|__toString))(\w+)\(/';
    const STATIC_CLASS_NAME = '/^(?!.*(?:self))(\w+)::\w+\(/';
    const STATIC_CLASS_METHOD = '/\w+::(?!.*that)(\w+)\(/';
    const PROPERTY_NAME = '/\$this\-\>(\w+)[\s+|=|;]+/';
    const ARRAY_KEY_DOUBLE_QUOTES = '/"(\w+)"\s+\=\>/';
    const ARRAY_KEY_SIMPLE_QUOTES = '/\'(\w+)\'\s+\=\>/';

    const EXTRACT_NAMING_REGEX = [
        self::VARIABLE_NAME,
        self::CLASS_NAME,
        self::CLASS_INSTANCE_NAME,
        self::INTERFACE_NAME,
        self::TRAIT_NAME,
        self::METHOD_NAME,
        self::METHOD_CALL,
        self::STATIC_CLASS_NAME,
        self::STATIC_CLASS_METHOD,
        self::PROPERTY_NAME,
        self::ARRAY_KEY_DOUBLE_QUOTES,
        self::ARRAY_KEY_SIMPLE_QUOTES,
        self::CONST_NAME
    ];

    /**
     * @test
     */
    public function generateWordingScoresFrom(string $codeBaseDirectoryPath)
    {
        $words = [];
        foreach ($this->getCodeBaseFiles($codeBaseDirectoryPath) as $filePath) {
            $sourceCode = file_get_contents($filePath);
            $words = array_merge(
                $words,
                $this->extractNamingFromNameSpaces($sourceCode),
                $this->extractNaming($sourceCode)
            );
        }

        $wordingScores = [];
        foreach ($words as $word) {
            isset($wordingScores[$word])
                ? $wordingScores[$word]++
                : $wordingScores[$word] = 1;
        }


        return $wordingScores;
    }

    private function extractNamingFromNameSpaces(string $content):array
    {
        $namespaces = [];
        preg_match_all('/namespace\s+(.+);/', $content, $namespaces);

        $domain = [];
        foreach ($namespaces[1] as $namespace) {
            $domain = array_merge($domain, explode('\\', $namespace));
        }
        return $domain;
    }

    private function extractNaming(string $content):array
    {
        $match = [];
        $names = [];
        foreach (self::EXTRACT_NAMING_REGEX as $regex) {
            preg_match_all($regex, $content, $match);
            $names = array_merge($names, $match[1]);
        }
        return $names;
    }

    private function getCodeBaseFiles(string $codeBaseDirectoryPath):array
    {
        $directory = new \RecursiveDirectoryIterator($codeBaseDirectoryPath);
        $iterator = new \RecursiveIteratorIterator($directory);
        $files = new \RegexIterator($iterator, '/^.+\.php$/i', \RecursiveRegexIterator::GET_MATCH);
        $sourceFiles = [];

        foreach ($files as $file) {
            $sourceFiles[] = $file[0];
        }

        return $sourceFiles;
    }
}