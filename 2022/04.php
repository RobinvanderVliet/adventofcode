<?php

$input = file_get_contents(__DIR__ . '/input/04.txt');

$fullSum = 0;
$partialSum = 0;
foreach (explode("\n", $input) as $value) {
	$pairs = explode(',', $value);
	if (count($pairs) !== 2) {
		continue;
	}

	$ranges = [];
	foreach ($pairs as $pair) {
		$ranges[] = range(...explode('-', $pair));
	}

	if (!array_diff($ranges[0], $ranges[1]) || !array_diff($ranges[1], $ranges[0])) {
		$fullSum++;
	}

	if (array_intersect(...$ranges)) {
		$partialSum++;
	}
}

echo 'Part 1 (full overlap): ';
echo $fullSum;
echo "\n";

echo 'Part 2 (partial overlap): ';
echo $partialSum;
echo "\n";
