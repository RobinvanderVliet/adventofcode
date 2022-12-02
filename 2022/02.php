<?php

$input = file_get_contents(__DIR__ . '/input/02.txt');

function calculatePoints(string $opponent, string $you): int
{
	$points = match ($you) {
		'rock'     => 1,
		'paper'    => 2,
		'scissors' => 3,
	};

	if ($opponent === $you) {
		$points += 3;
	} elseif (
		$opponent === 'rock' && $you === 'paper'
		|| $opponent === 'paper' && $you === 'scissors'
		|| $opponent === 'scissors' && $you === 'rock'
	) {
		$points += 6;
	}

	return $points;
}

$points = 0;
foreach (explode("\n", $input) as $value) {
	if (strlen($value) < 3) {
		continue;
	}

	$opponent = match (substr($value, 0, 1)) {
		'A' => 'rock',
		'B' => 'paper',
		'C' => 'scissors',
	};

	$you = match (substr($value, -1)) {
		'X' => 'rock',
		'Y' => 'paper',
		'Z' => 'scissors',
	};

	$points += calculatePoints($opponent, $you);
}

echo 'Part 1 (total score): ';
echo $points;
echo "\n";

$points = 0;
foreach (explode("\n", $input) as $value) {
	if (strlen($value) < 3) {
		continue;
	}

	$opponent = match (substr($value, 0, 1)) {
		'A' => 'rock',
		'B' => 'paper',
		'C' => 'scissors',
	};

	$you = match (substr($value, -1)) {
		'X' => match ($opponent) {
			'rock'     => 'scissors',
			'paper'    => 'rock',
			'scissors' => 'paper',
		},
		'Y' => $opponent,
		'Z' => match ($opponent) {
			'rock'     => 'paper',
			'paper'    => 'scissors',
			'scissors' => 'rock',
		},
	};

	$points += calculatePoints($opponent, $you);
}

echo 'Part 2 (total score): ';
echo $points;
echo "\n";
