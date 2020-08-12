<?php

namespace Test\WordCloud\Dataset;

class ClassExample
{
    const STRING_CONSTANT_NAME_FIRST_EXAMPLE = 'simpleConstantValueExample';
    const STRING_CONSTANT_NAME_SECOND_EXAMPLE = 'simpleConstantValueSecondExample';

    const ARRAY_CONSTANT_NAME_EXAMPLE = [
        self::STRING_CONSTANT_NAME_FIRST_EXAMPLE,
        self::STRING_CONSTANT_NAME_SECOND_EXAMPLE,
    ];

    /**
     * @test
     */
    public function methodNameExample(string $stringArgument,int $integerArgument,array $arrayArgument)
    {
        $stringVariable = '';
        $integerVariable = 1;

        foreach ($this->methodCall() as $foreachIndex=> $foreachElement) {
            $foreachElement[$foreachIndex]['stringKey'] = new InstanceClassName();
        }

        $arrayVariable = [];

        foreach ($arrayVariable as $foreachElement) {
            isset($foreachElement['key'])
                ? $foreachElement['key']++
                : $foreachElement['key'] = 1;
        }

        return $arrayVariable;
    }

    private function methodCall(){
        return [];
    }
}