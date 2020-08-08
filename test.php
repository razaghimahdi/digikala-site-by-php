<?php

$name = 'a:5:{i:0;s:1:"3";i:1;s:1:"3";i:2;s:1:"3";i:3;s:1:"2";i:4;s:1:"2";}';


print_r($name);

echo "<br>";

$name2 = unserialize($name);
print_r($name2);

echo "<br>";
