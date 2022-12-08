<?php

$input = file_get_contents(__DIR__ . '/input/08.txt');

$grid = [];
foreach (explode("\n", $input) as $y => $row) {
	if ($row === '') {
		continue;
	}

	foreach (str_split($row) as $x => $char) {
		$grid[$y][$x] = (int) $char;
	}
}

function isCellVisibleLeft(array $grid, int $x, int $y): bool
{
	for ($i = 0; $i < $x; $i++) {
		if ($grid[$y][$i] >= $grid[$y][$x]) {
			return false;
		}
	}

	return true;
}

function isCellVisibleRight(array $grid, int $x, int $y): bool
{
	for ($i = count($grid[0]) - 1; $i > $x; $i--) {
		if ($grid[$y][$i] >= $grid[$y][$x]) {
			return false;
		}
	}

	return true;
}

function isCellVisibleUp(array $grid, int $x, int $y): bool
{
	for ($i = 0; $i < $y; $i++) {
		if ($grid[$i][$x] >= $grid[$y][$x]) {
			return false;
		}
	}

	return true;
}

function isCellVisibleDown(array $grid, int $x, int $y): bool
{
	for ($i = count($grid) - 1; $i > $y; $i--) {
		if ($grid[$i][$x] >= $grid[$y][$x]) {
			return false;
		}
	}

	return true;
}

function isCellVisible(array $grid, int $x, int $y): bool
{
	return isCellVisibleLeft($grid, $x, $y) || isCellVisibleRight($grid, $x, $y)
		|| isCellVisibleUp($grid, $x, $y) || isCellVisibleDown($grid, $x, $y);
}

function calculateCellsLeft(array $grid, int $x, int $y): int
{
	$cells = 0;

	$i = $x;
	while (true) {
		$i--;

		if (!isset($grid[$y][$i])) {
			break;
		}

		$cells++;

		if ($grid[$y][$i] >= $grid[$y][$x]) {
			break;
		}
	}

	return $cells;
}

function calculateCellsRight(array $grid, int $x, int $y): int
{
	$cells = 0;

	$i = $x;
	while (true) {
		$i++;

		if (!isset($grid[$y][$i])) {
			break;
		}

		$cells++;

		if ($grid[$y][$i] >= $grid[$y][$x]) {
			break;
		}
	}

	return $cells;
}

function calculateCellsUp(array $grid, int $x, int $y): int
{
	$cells = 0;

	$i = $y;
	while (true) {
		$i--;

		if (!isset($grid[$i][$x])) {
			break;
		}

		$cells++;

		if ($grid[$i][$x] >= $grid[$y][$x]) {
			break;
		}
	}

	return $cells;
}

function calculateCellsDown(array $grid, int $x, int $y): int
{
	$cells = 0;

	$i = $y;
	while (true) {
		$i++;

		if (!isset($grid[$i][$x])) {
			break;
		}

		$cells++;

		if ($grid[$i][$x] >= $grid[$y][$x]) {
			break;
		}
	}

	return $cells;
}

function calculateCells(array $grid, int $x, int $y): int
{
	return array_product([
		calculateCellsLeft($grid, $x, $y),
		calculateCellsRight($grid, $x, $y),
		calculateCellsUp($grid, $x, $y),
		calculateCellsDown($grid, $x, $y),
	]);
}

$count = 0;
$score = 0;
foreach ($grid as $y => $row) {
	foreach ($row as $x => $char) {
		if (isCellVisible($grid, $x, $y)) {
			$count++;
		}

		$score = max($score, calculateCells($grid, $x, $y));
	}
}

echo 'Part 1 (visible trees): ';
echo $count;
echo "\n";

echo 'Part 2 (highest scenic score): ';
echo $score;
echo "\n";
