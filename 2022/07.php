<?php

$input = file_get_contents(__DIR__ . '/input/07.txt');

$data = [];
$command = null;
$output = [];
foreach (explode("\n", $input) as $value) {
	if (str_starts_with($value, '$ ')) {
		if ($command) {
			$data[] = [$command, $output];
			$output = [];
		}

		$command = substr($value, 2);
	} elseif ($command && $value !== '') {
		$output[] = $value;
	}
}

if ($command) {
	$data[] = [$command, $output];
}

$folder = [];
$sizes = [];
foreach ($data as $line) {
	$command = $line[0];
	$output = $line[1];

	if (str_starts_with($command, 'cd ')) {
		$commandFolder = substr($command, 3);
		if ($commandFolder === '/') {
			$folder = [];
		} elseif ($commandFolder === '..') {
			array_pop($folder);
		} else {
			$folder[] = $commandFolder;
		}
	} elseif ($command === 'ls') {
		foreach ($output as $value) {
			$size = (int) strstr($value, ' ', true);
			if (!$size) {
				continue;
			}

			for ($i = 0; $i <= count($folder); $i++) {
				$path = '/' . implode('/', array_slice($folder, 0, $i));
				if (!isset($sizes[$path])) {
					$sizes[$path] = 0;
				}
				$sizes[$path] += $size;
			}
		}
	}
}

$maxSize = 100000;
$sum = array_sum(array_filter($sizes, fn(int $size): bool => $size <= $maxSize));

echo 'Part 1: ';
echo $sum;
echo "\n";

$totalDisk = 70000000;
$needed = 30000000;
$remaining = $totalDisk - $sizes['/'];
$smallest = min(array_filter($sizes, fn(int $size): bool => $needed <= $remaining + $size));

echo 'Part 2: ';
echo $smallest;
echo "\n";
