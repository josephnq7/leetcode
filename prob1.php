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
    $longest = 0;
    $strCheck = '';
    $startIndex = 0;
    $i = 0;
    while ($i < strlen($s)) {
        if (strpos($strCheck, $s[$i]) === false) {
            $strCheck .= $s[$i];
            $i++;
        } else {
            // count character
            $currentLength = strlen($strCheck);
            if ($longest < $currentLength) {
                $longest = $currentLength;
            }
            $startIndex++;
            $i = $startIndex;

            //reset $strCheck;
            $strCheck = '';
        }
    }

    if (strlen($strCheck) > $longest) {
        $longest = strlen($strCheck);
    }
    return $longest;
}