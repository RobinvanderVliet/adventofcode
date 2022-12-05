<?php

$input = file_get_contents(__DIR__ . '/input/05.txt');

$data = explode("\n\n", $input);

$keys = [];
$stacks = [];

foreach (array_reverse(explode("\n", $data[0])) as $number => $row) {
	foreach (str_split($row) as $key => $char) {
		if ($char === ' ') {
			continue;
		}

		if (!$number) {
			$keys[$key] = $char;
			$stacks[$char] = [];
		} elseif (isset($keys[$key])) {
			$stacks[$keys[$key]][] = $char;
		}
	}
}

$firstStacks = $stacks;
$secondStacks = $stacks;

foreach (explode("\n", $data[1]) as $command) {
	preg_match('/^move ([0-9]+) from ([0-9]) to ([0-9])$/', $command, $matches);
	if (!$matches) {
		continue;
	}

	array_push($firstStacks[$matches[3]], ...array_reverse(array_splice($firstStacks[$matches[2]], -$matches[1])));
	array_push($secondStacks[$matches[3]], ...array_splice($secondStacks[$matches[2]], -$matches[1]));
}

echo 'Part 1: ';
foreach ($firstStacks as $key => $value) {
	echo end($firstStacks[$key]);
}
echo "\n";

echo 'Part 2: ';
foreach ($secondStacks as $key => $value) {
	echo end($secondStacks[$key]);
}
echo "\n";
