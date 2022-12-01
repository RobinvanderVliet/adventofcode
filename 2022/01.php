<?php

$input = file_get_contents('input/01.txt');

$sums = [];
foreach (explode("\n\n", $input) as $value) {
	$sums[] = array_sum(explode("\n", $value));
}

echo 'Part 1 (sum of the calories of all the elves): ';
echo max($sums);
echo "\n";

rsort($sums);

echo 'Part 2 (sum of top 3 elves with most calories): ';
echo array_sum(array_slice($sums, 0, 3));
echo "\n";
