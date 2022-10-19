<?php
/**
 * 658. Find K Closest Elements
Medium


Given a sorted integer array arr, two integers k and x, return the k closest integers to x in the array. The result should also be sorted in ascending order.

An integer a is closer to x than an integer b if:

|a - x| < |b - x|, or
|a - x| == |b - x| and a < b
 

Example 1:

Input: arr = [1,2,3,4,5], k = 4, x = 3
Output: [1,2,3,4]
Example 2:

Input: arr = [1,2,3,4,5], k = 4, x = -1
Output: [1,2,3,4]
 

Constraints:

1 <= k <= arr.length
1 <= arr.length <= 104
arr is sorted in ascending order.
-104 <= arr[i], x <= 104
 */

 /**
  * Better solution using binary search

  class Solution {

     function findClosestElements($arr, $k, $x) {
        $len = count($arr);

        $l = 0;
        $r = $len - 1;

        $key = 0;
        $val = $arr[$key];

        while ($l <= $r) {
            $mid = floor(($l + $r) / 2);
            $curDiff = abs($arr[$mid] - $x);
            $prevDiff = abs($val - $x);

            if ($curDiff < $prevDiff || ($curDiff == $prevDiff && $arr[$mid] < $val)) {
                $key = $mid;
                $val = $arr[$mid];
            }

            if ($arr[$mid] < $x) {
                $l = $mid + 1;

            } else if($arr[$mid] > $x) {
                $r = $mid - 1;
            } else {
                //equally
                break;
            }
        }


        $l = $r = $key;

        while (($r - $l + 1) < $k) {
            if ($l == 0) {
                $r++;
            } else if ($r == $len - 1) {
                $l--;
            } else {

                $leftVal = abs($arr[$l-1] - $x);
                $rightVal = abs($arr[$r+1] - $x);

                if ($leftVal < $rightVal) {
                    $l--;
                } else if ($leftVal > $rightVal) {
                    $r++;
                } else {
                    //equally
                    if ($arr[$l - 1] < $arr[$r + 1]) {
                        $l--;
                    } else {
                        $r++;
                    }
                }
            }
        }


        return array_slice($arr, $l, $r - $l + 1);

    }

    ** Another better solution
    class Solution {

     function findClosestElements($arr, $k, $x) {
        $len = count($arr);

        $l = 0;
        $r = $len - $k;


        while ($l < $r) {
            $mid = floor(($l + $r) / 2);
            
            if ($x - $arr[$mid] > $arr[$mid + $k] - $x) {
                $l = $mid + 1;
            } else {
                $r = $mid;
            }
            
        }


        return array_slice($arr, $l, $k);

    }
    
}
    
}
  */

 class Solution {

    /**
     * @param Integer[] $arr
     * @param Integer $k
     * @param Integer $x
     * @return Integer[]
     */
    function findClosestElements($arr, $k, $x) {
        $len = count($arr);
        $key = array_search($x, $arr);
        if ($key !== false ) {
            //$x in array
            return $this->searchAround($arr, $key, $k, $x);
        } else {
            if ($x < $arr[0]) {
                //$x far from left, going search in right part
                return $this->searchAround($arr, -1, $k, $x);
            } else {
                if ($x > $arr[$len-1]) {
                    //$x far from right, going search in left part
                    return $this->searchAround($arr, $len, $k, $x);
                } else {
                    //in the middle
                    $lo = 0;
                    $hi = $len - 1;
                    while (true) {
                        $mid = floor(($lo + $hi) / 2);
                        $midVal = $arr[$mid];
                        $left = $mid - 1;
                        $right = $mid + 1;
                        $leftVal = $left >= 0 ? $arr[$left] : PHP_INT_MIN;
                        $rightVal = $mid < $len ? $arr[$right] : PHP_INT_MAX;
                        
                        if ($left >= 0 && $x > $leftVal && $x < $midVal) {
                            return $this->searchAround($arr, null, $k, $x, $left, $mid);
                        } else if ($right < $len && $x > $midVal && $x < $rightVal) {
                            return $this->searchAround($arr, null, $k, $x, $mid, $right);
                        } else if ($x > $leftVal && $x < $rightVal) {
                            return $this->searchAround($arr, null, $k, $x, $left, $right);
                        } else {
                            if ($x < $midVal) {
                                $hi = $mid;
                            } else if ($x > $midVal) {
                                $lo = $mid;
                            }
                        }

                        if ($lo == $hi || $lo > $hi || $lo < 0 || $hi > $len) {
                            break;
                        }
                    }
                   
                    
                }
            }
        }
    }
    
    function searchAround($arr, $key, $k, $x, $lo = null, $hi = null)
    {
        $result = [];
        
        if (is_null($key)) {
            $left = $lo;
            $right = $hi;
        } else {
            if (isset($arr[$key]) && $arr[$key] == $x) {
                array_push($result, $x);
            }

            $left = $key - 1;
            $right = $key + 1;
        }
       
        while (true) {
            if ($left < 0 && $right >= count($arr)) {
                break;
            }
            if (count($result) == $k) {
                break;
            }
            $lItem = isset($arr[$left]) ? $arr[$left] :  null;
            $rItem = isset($arr[$right]) ? $arr[$right] : null;
            
            if ($lItem !== null && $rItem !== null) {
                if (abs($lItem - $x) < abs($rItem - $x)) {
                    //adding left
                    array_unshift($result, $lItem);
                    $left--;
                } else if (abs($lItem - $x) > abs($rItem - $x)) {
                    //adding right
                    array_push($result, $rItem);
                    $right++;
                } else {
                    //equal
                    //right item always greater then left item
                    array_unshift($result, $lItem);
                    $left--;
                }
            } else if ($rItem !== null) {
                //adding right
                array_push($result, $rItem);
                $right++;
            } else if ($lItem !== null) {
                //adding left
                array_unshift($result, $lItem);
                $left--;
            }
            
        }
        
        return $result;
        
            
    }
}