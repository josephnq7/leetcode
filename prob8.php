<?php

/**
 *
 * Given a string s, find the length of the longest substring without repeating characters.



Example 1:

Input: s = "abcabcbb"
Output: 3
Explanation: The answer is "abc", with the length of 3.
Example 2:

Input: s = "bbbbb"
Output: 1
Explanation: The answer is "b", with the length of 1.
Example 3:

Input: s = "pwwkew"
Output: 3
Explanation: The answer is "wke", with the length of 3.
Notice that the answer must be a substring, "pwke" is a subsequence and not a substring.


Constraints:

0 <= s.length <= 5 * 104
s consists of English letters, digits, symbols and spaces.
 *
 * @param $s
 * @return int
 */
  function lengthOfLongestSubstring($s) {
    	$s = str_split($s);
        $substr = [];
        $longest = 0;
        $leftPointer = 0;
        for ($i = 0; $i < count($s); $i++) {
            $char = $s[$i];
            if (isset($substr[$char])) {

            } else {
                
            }
            while(isset($substr[$char])) {
                unset($substr[$s[$leftPointer]]);
                $leftPointer++;
            }

            $substr[$char] = 1;
            if (count($substr) > $longest) {
                $longest = count($substr);
            }

        }
        return $longest;
    }
    
    echo lengthOfLongestSubstring("pwwkew");