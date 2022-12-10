<?php

$input = file_get_contents(__DIR__ . '/input/09.txt');

function calculateVisits(array $data, int $knotAmount): int
{
	$knots = array_fill(0, $knotAmount, [0, 0]);
	$visits = [];

	foreach ($data as $value) {
		preg_match('/^([LRUD]) ([0-9]+)$/', $value, $matches);
		if (!$matches) {
			continue;
		}

		$direction = $matches[1];
		$amount = (int) $matches[2];

		for ($i = 0; $i < $amount; $i++) {
			$knots[0][0] += match ($direction) {
				'L'     => -1,
				'R'     => 1,
				default => 0,
			};
			$knots[0][1] += match ($direction) {
				'U'     => -1,
				'D'     => 1,
				default => 0,
			};

			for ($j = 1; $j < $knotAmount; $j++) {
				$x = $knots[$j - 1][0] - $knots[$j][0];
				$y = $knots[$j - 1][1] - $knots[$j][1];

				if (abs($x) < 2 && abs($y) < 2) {
					continue;
				}

				$knots[$j][0] += min(max($x, -1), 1);
				$knots[$j][1] += min(max($y, -1), 1);
			}

			$tail = $knots[$knotAmount - 1];
			if (!in_array($tail, $visits)) {
				$visits[] = $tail;
			}
		}
	}

	return count($visits);
}

$data = explode("\n", $input);

echo 'Part 1 (two knots): ';
echo calculateVisits($data, 2);
echo "\n";

echo 'Part 2 (ten knots): ';
echo calculateVisits($data, 10);
echo "\n";
