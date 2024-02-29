<?php
/**
Number of subarrays having sum exactly equal to k
*/

/** 
 * using prefix sum
 */
function countConsecutiveSubarraysWithSum($arr, $targetSum) {
    $count = 0;
    $currentSum = 0;
    $sumCountMap = [0 => 1]; // Stores the count of each sum encountered so far

    foreach ($arr as $num) {
        $currentSum += $num;
        echo "NUM: " . $num . PHP_EOL;
        print_r($sumCountMap);
        if (isset($sumCountMap[$currentSum - $targetSum])) {
            $count += $sumCountMap[$currentSum - $targetSum];
            echo "AAAA " . $count . PHP_EOL;
        }
        $sumCountMap[$currentSum] = isset($sumCountMap[$currentSum]) ? $sumCountMap[$currentSum] + 1 : 1;
    }

    return $count;
}

// Example usage
$arr = [1, 3, 1, 5, 5, 4, 5, 6, 7, 1, 9, 8, 3, 4, 5, 3, 5, 7, 7, 8, 1, 3, 2];
$targetSum = 10;
echo countConsecutiveSubarraysWithSum($arr, $targetSum); // Output: 3