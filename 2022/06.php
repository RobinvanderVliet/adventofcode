<?php

$input = file_get_contents(__DIR__ . '/input/06.txt');

function findStart(string $input, int $characters): ?int
{
	$buffer = [];
	foreach (str_split($input) as $key => $char) {
		$buffer[] = $char;
		if (count($buffer) > $characters) {
			array_shift($buffer);
		}

		if (count(array_flip($buffer)) === $characters) {
			return $key + 1;
		}
	}

	return null;
}

echo 'Part 1: ';
echo findStart($input, 4);
echo "\n";

echo 'Part 2: ';
echo findStart($input, 14);
echo "\n";
