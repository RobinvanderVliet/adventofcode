<?php

$input = file_get_contents(__DIR__ . '/input/03.txt');

$priorities = array_combine(array_merge(range('a', 'z'), range('A', 'Z')), range(1, 52));

$sum = 0;
foreach (explode("\n", $input) as $backpack) {
	$length = strlen($backpack);
	if ($length === 0) {
		continue;
	}

	$compartments = [
		substr($backpack, 0, $length / 2),
		substr($backpack, $length / 2),
	];

	foreach ($priorities as $type => $priority) {
		$found = true;
		foreach ($compartments as $compartment) {
			if (!str_contains($compartment, $type)) {
				$found = false;
				break;
			}
		}

		if ($found) {
			$sum += $priority;
			break;
		}
	}
}

echo 'Part 1 (both compartments): ';
echo $sum;
echo "\n";

$sum = 0;
foreach (array_chunk(explode("\n", $input), 3) as $group) {
	if (count($group) === 0) {
		continue;
	}

	foreach ($priorities as $type => $priority) {
		$found = true;
		foreach ($group as $backpack) {
			if (!str_contains($backpack, $type)) {
				$found = false;
				break;
			}
		}

		if ($found) {
			$sum += $priority;
			break;
		}
	}
}

echo 'Part 2 (badges of groups): ';
echo $sum;
echo "\n";
