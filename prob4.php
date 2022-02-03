<?php
/**
 * 4. Median of Two Sorted Arrays

Given two sorted arrays nums1 and nums2 of size m and n respectively, return the median of the two sorted arrays.

The overall run time complexity should be O(log (m+n)).

 

Example 1:

Input: nums1 = [1,3], nums2 = [2]
Output: 2.00000
Explanation: merged array = [1,2,3] and median is 2.
Example 2:

Input: nums1 = [1,2], nums2 = [3,4]
Output: 2.50000
Explanation: merged array = [1,2,3,4] and median is (2 + 3) / 2 = 2.5.
 

Constraints:

nums1.length == m
nums2.length == n
0 <= m <= 1000
0 <= n <= 1000
1 <= m + n <= 2000
-106 <= nums1[i], nums2[i] <= 106
 */
class Solution {

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Float
     */
    function findMedianSortedArrays($nums1, $nums2) {
        
        if (count($nums1) < count($nums2)) {    //make sure nums2 always smaller than nums1
            $temp = $nums1;
            $nums1 = $nums2;
            $nums2 = $temp;    
        }
        $totalSize = count($nums1) + count($nums2);
        $halfSize = floor($totalSize / 2);
        
        $l = 0;
        $r = count($nums2) - 1;
        
        while(true) {
            $mid2 = floor(($l + $r) / 2);
            $mid1 = $halfSize - $mid2 - 2;
            if ($mid2 < 0) {
                $left2 = PHP_INT_MIN;
            } else {
                $left2 = $nums2[$mid2];
            }
            
            if ($mid2 + 1 <  (count($nums2))) {
                $right2 = $nums2[$mid2 + 1];
                
            } else {
                $right2 = PHP_INT_MAX;
            }
            
            if ($mid1 < 0) {
                $left1 = PHP_INT_MIN;
            } else {
                $left1 = $nums1[$mid1];
            }
            
            if ($mid1 + 1 < (count($nums1))) {
                $right1 = $nums1[$mid1 + 1];           
            } else {
                $right1 = PHP_INT_MAX;
            }
            
            if ($left1 <= $right2 && $left2 <= $right1) {
                //correct partition
                if ($totalSize % 2 == 0) {
                    //even array length
                    return (max($left1, $left2) + min($right1, $right2)) / 2;
                } else {
                    return min($right2, $right1);
                }
            } else if ($left1 > $right2) {
                $l = $mid2 + 1;
            } else if ($left2 > $right1) {
                $r = $mid2 - 1;
            }
        }
    }
}