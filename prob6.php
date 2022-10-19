<?php
/**
 * 286. wall and gate
 * you are given m x n grid rooms initialized with these three possible values
 *  -1 : A wall or an obstacle
 *  0: A gate
 *  INF: empty room. we use 2147483647 to represent INF
 * 
 * Fill each empty room with the distance to its nearest gate. If it is impossible to reach a gate, it should be filled with INF
 * 
 * Input: rooms = [
 *      [2147483647, -1, 0, 2147483647],
 *      [2147483647, 2147483647, 2147483647, -1],
 *      [2147483647, -1, 2147483647, -1],
 *      [0, -1, 2147483647, 2147483647]
 * ]
 * 
 * Output: [
 *      [3, -1, 0, 1],
 *      [2, 2, 1, -1],
 *      [1, -1, 2, -1],
 *      [0, -1, 3, 4]
 * ]
 * 
 */

 function wallAndGate(array $rooms)
{
	$rows = count($rooms);
	$cols = count($rooms[0]);
	
	$visited = [];
	$q = new SplQueue();
	
	$myfunc = function ($r, $c) use ($rows, $cols, &$rooms, &$visited, $q)
	{
		// global $rows;
		// global $cols;
		// global $rooms;
		// global $q;
		// global $visited;
		
		if ($r == $rows || $r < 0 || $c == $cols || $c < 0 || $rooms[$r][$c] == -1
			|| isset($visited["$r-$c"])) {
			return;
		}
		// print_r($q->);
		// print "$r - $c AAAAAAA" . PHP_EOL;
		
		// echo "---Adding [$r, $c]" . PHP_EOL;
		

		
		$visited["$r-$c"] = 1;
		$q->enqueue([$r, $c]);
		
		// print_r($visited);
	};

	
	for ($i = 0; $i < $rows; $i++) {
		for ($j = 0; $j < $cols; $j++) {
			if ($rooms[$i][$j] == 0) {
				$q->enqueue([$i, $j]);
				$visited["$i-$j"] = 1;
			}
		}
	}
	
	$dist = 0;
	
	$i = 0;
	while ($q->count()) {
		$count = $q->count();
		// print "============== COUNT BEFORE: " . $q->count() . PHP_EOL;
		for ($i = 0; $i < $count; $i++) {
			$item = $q->dequeue();
			// print "============== COUNT AFTER: " . $q->count() . PHP_EOL;
			// print_r($item);
			// print "==============" . PHP_EOL;
			$r = $item[0];
			$c = $item[1];
			
			$rooms[$r][$c] = $dist;
			
			$myfunc($r, $c + 1);
			$myfunc($r, $c - 1);
			$myfunc($r + 1, $c);
			$myfunc($r - 1, $c);
		}

		$dist++;
		$i++;
	}
	
	return $rooms;
}


$rooms = [
       [2147483647, -1, 0, 2147483647],
       [2147483647, 2147483647, 2147483647, -1],
       [2147483647, -1, 2147483647, -1],
       [0, -1, 2147483647, 2147483647]
  ];
  
print_r(wallAndGate($rooms));



// $q->enqueue(1);
// $q->enqueue(2);
// $q->enqueue(3);
// $a = $q->dequeue();
// print $a;




