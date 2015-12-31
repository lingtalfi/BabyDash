<?php

use BabyDash\BabyDashTool;
use PhpBeast\AuthorTestAggregator;
use PhpBeast\PrettyTestInterpreter;
use PhpBeast\Tool\ComparisonErrorTableTool;


require_once "bigbang.php";



$agg = AuthorTestAggregator::create();

function test($str, $exp){
    global $agg;

    $agg->addTest(function (&$msg, $testNumber) use ($str, $exp) {
        $res = BabyDashTool::parse($str);
        $ret = ($res === $exp);
        if (false === $ret) {
            ComparisonErrorTableTool::collect($testNumber, $exp, $res);
        }
        return $ret;
    });
}

//------------------------------------------------------------------------------/
// BASIC TEST
//------------------------------------------------------------------------------/
$s = <<<EEE
- apple
- banana
- cherry
EEE;

test($s, [
    'apple',
    'banana',
    'cherry',
]);



//------------------------------------------------------------------------------/
// BASIC INDENTATION
//------------------------------------------------------------------------------/
$s = <<<EEE
- fruits:
----- apple
----- banana
- cherry
EEE;

test($s, [
    'fruits' => [
        'apple',
        'banana',
    ],
    'cherry',
]);



//------------------------------------------------------------------------------/
// LINE NOT ENDING WITH COLON: VALUE IGNORED
//------------------------------------------------------------------------------/
$s = <<<EEE
- fruits
----- apple
----- banana
- cherry
EEE;


test($s, [
    [
        'apple',
        'banana',
    ],
    'cherry',
]);


PrettyTestInterpreter::create()->execute($agg);
ComparisonErrorTableTool::display();