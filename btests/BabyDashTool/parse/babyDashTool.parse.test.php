<?php

use BabyDash\BabyDashTool;
use PhpBeast\AuthorTestAggregator;
use PhpBeast\PrettyTestInterpreter;
use PhpBeast\Tool\ComparisonErrorTableTool;


require_once "bigbang.php";


$agg = AuthorTestAggregator::create();


$s = <<<EEE
- apple
- banana
- cherry
EEE;


$agg->addTest(function (&$msg, $testNumber) use ($s) {
    $res = BabyDashTool::parse($s);
    $expected = [
        'apple',
        'banana',
        'cherry',
    ];

    $ret = ($res === $expected);
    if (false === $ret) {
        ComparisonErrorTableTool::collect($testNumber, $expected, $res);
    }
    return $ret;
});


$s = <<<EEE
- fruits:
----- apple
----- banana
- cherry
EEE;


$agg->addTest(function (&$msg, $testNumber) use ($s) {
    $res = BabyDashTool::parse($s);
    $expected = [
        'fruits' => [
            'apple',
            'banana',
        ],
        'cherry',
    ];

    $ret = ($res === $expected);
    if (false === $ret) {
        ComparisonErrorTableTool::collect($testNumber, $expected, $res);
    }
    return $ret;
});


PrettyTestInterpreter::create()->execute($agg);
ComparisonErrorTableTool::display();