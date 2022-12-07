<?php

$input = file_get_contents(__DIR__ . '/input/infi.txt');

function step(array $position, int $direction, int $steps): array
{
	$position[0] += match ($direction) {
		45, 90, 135   => $steps,
		225, 270, 315 => -$steps,
		default       => 0,
	};
	$position[1] += match ($direction) {
		135, 180, 225 => $steps,
		0, 45, 315    => -$steps,
		default       => 0,
	};

	return $position;
}

$position = [0, 0];
$direction = 0;
$track = [];

foreach (explode("\n", $input) as $value) {
	preg_match('/^([a-z]+) (-?[0-9]+)$/', $value, $matches);
	if (!$matches) {
		continue;
	}

	$command = $matches[1];
	$amount = (int) $matches[2];

	if ($command === 'draai') {
		$direction += $amount;
		$direction %= 360;

		while ($direction < 0) {
			$direction += 360;
		}
	} elseif ($command === 'loop') {
		for ($i = 0; $i < abs($amount); $i++) {
			$position = step($position, $direction, $amount > 0 ? 1 : -1);
			$track[] = $position;
		}
	} elseif ($command === 'spring') {
		$position = step($position, $direction, $amount);
		$track[] = $position;
	}
}

echo 'Part 1 (Manhattan distance): ';
echo abs($position[0]) + abs($position[1]);
echo "\n";

echo 'Part 2 (word in snow):';
echo "\n";

$trackX = array_column($track, 0);
$trackY = array_column($track, 1);

for ($y = min($trackY); $y <= max($trackY); $y++) {
	for ($x = min($trackX); $x <= max($trackX); $x++) {
		echo in_array([$x, $y], $track) ? '*' : ' ';
	}
	echo "\n";
}
