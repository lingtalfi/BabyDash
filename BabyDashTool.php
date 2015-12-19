<?php

namespace BabyDash;

/*
 * LingTalfi 2015-12-19
 */
use IndentedLines\KeyFinder\KeyFinder;
use IndentedLines\NodeToArrayConvertor\NodeToArrayConvertor;
use IndentedLines\NodeTreeBuilder\NodeTreeBuilder;

class BabyDashTool {


    public static function parse($s)
    {
        $node = NodeTreeBuilder::create()
            ->setKeyFinder(KeyFinder::create()->setKvSep(':'))
            //
            ->setUseMultiLine(false)
            ->setUseComment(true)
            ->setCommentSymbol('#')
            //
            ->setHasLeadingIndentChar(true)
            ->setIndentChar('-')
            ->buildNode($s);
        return NodeToArrayConvertor::create()->convert($node);
    }
    
}
