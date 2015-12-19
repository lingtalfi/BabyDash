BabyDash
=============
2015-12-19


BabyDash is a notation to write an array in a language independent manner.


BabyDash can be installed as a [planet](https://github.com/lingtalfi/Observer/blob/master/article/article.planetReference.eng.md).


Examples
-------------- 


### The simplest example possible


```php
<?php


use BabyDash\BabyDashTool;

require_once "bigbang.php";

$s = <<<EEE
- apple
- banana
- cherry
EEE;

a(BabyDashTool::parse($s));  // [apple, banana, cherry]
```



### The complex example 

This example demonstrates how belongliness can be created with indentation, and how special values are treated/casted.


```php
<?php


use BabyDash\BabyDashTool;

require_once "bigbang.php";



$s = <<<EEE
- hi
- hay
- ho:
----- bloom
----- doom:
--------- game
--------- word
--------- 78
--------- 78.4
--------- true
--------- false
--------- 
--------- # this is also empty string
--------- null
----- zoom
- hue
EEE;

a(BabyDashTool::parse($s));
```

The result of the above code is the following array:

```php
array (size=3)
  0 => string 'apple' (length=5)
  1 => string 'banana' (length=6)
  2 => string 'cherry' (length=6)

array (size=4)
  0 => string 'hi' (length=2)
  1 => string 'hay' (length=3)
  'ho' => 
    array (size=3)
      0 => string 'bloom' (length=5)
      'doom' => 
        array (size=9)
          0 => string 'game' (length=4)
          1 => string 'word' (length=4)
          2 => int 78
          3 => float 78.4
          4 => boolean true
          5 => boolean false
          6 => string '' (length=0)
          7 => string '' (length=0)
          8 => null
      1 => string 'zoom' (length=4)
  2 => string 'hue' (length=3)

```




Dependencies
------------------

- [lingtalfi/IndentedLines 1.0.2](https://github.com/lingtalfi/IndentedLines)




History Log
------------------
    
- 1.0.0 -- 2015-12-19

    - initial commit
    
    

