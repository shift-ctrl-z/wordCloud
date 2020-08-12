<?php

namespace WordCloud;

class CloudGenerator
{
    const VARIABLE_NAME = '/\$(?!.*this)(\w+)/';
    const CLASS_NAME = '/class\s+(\w+)/';
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
    public function extractNamesFromCodeBase($codeBaseDirectorypath)
    {
        $directory = new \RecursiveDirectoryIterator($codeBaseDirectorypath);
        $iterator = new \RecursiveIteratorIterator($directory);
        $regex = new \RegexIterator($iterator, '/^.+\.php$/i', \RecursiveRegexIterator::GET_MATCH);
        $sourceFiles = [];
        foreach ($regex as $file) {
            $sourceFiles[] = $file[0];
        }
        $names = [];
        foreach ($sourceFiles as $filePath) {
            $sourceCode = file_get_contents($filePath);
            $names = array_merge(
                $names,
                $this->extractNamingFromNameSpaces($sourceCode),
                $this->extractNaming($sourceCode)
            );
        }

        $scoreNames = [];
        foreach ($names as $name) {
            isset($scoreNames[$name])
                ? $scoreNames[$name]++
                : $scoreNames[$name] = 1;
        }


        return $scoreNames;
    }

    /**
     * @param $content
     * @param $namespaces
     * @return array
     */
    private function extractNamingFromNameSpaces($content)
    {
        $namespaces = [];
        preg_match_all('/namespace\s+(.+);/', $content, $namespaces);

        $domain = [];
        foreach ($namespaces[1] as $namespace) {
            $domain = array_merge($domain, explode('\\', $namespace));
        }
        return $domain;
    }

    /**
     * @param $content
     * @param array $matchs
     * @param array $names
     * @return array
     */
    private function extractNaming($content)
    {
        $matchs = [];
        $names = [];
        foreach (self::EXTRACT_NAMING_REGEX as $regex) {
            preg_match_all($regex, $content, $matchs);
            $names = array_merge($names, $matchs[1]);
        }
        return $names;
    }
}