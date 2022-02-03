<?php
/**
 * 5. Longest Palindromic Substring

Given a string s, return the longest palindromic substring in s.

 

Example 1:

Input: s = "babad"
Output: "bab"
Explanation: "aba" is also a valid answer.
Example 2:

Input: s = "cbbd"
Output: "bb"
 

Constraints:

1 <= s.length <= 1000
s consist of only digits and English letters.
 */

 class Solution {
    
    private $maxLen = 0;
    private $start = 0;

    /**
     * @param String $s
     * @return String
     */
    function longestPalindrome($s) {
        if ($s == null || strlen($s) < 1)
            return "";

        if (strlen($s) == 1) {
            return $s;
        }
        
        for ($i = 0; $i < strlen($s) - 1; $i++) {
            $oddLength = $this->expandAroundCeter($s, $i, $i);
            $evenLength = $this->expandAroundCeter($s, $i, $i+1);
        }
        
        return substr($s, $this->start, $this->maxLen);
        
    }
    
    function expandAroundCeter($s, $left, $right) 
    {
        while ($left >= 0 && $right < strlen($s) && $s[$left] == $s[$right]) {
            $left--;
            $right++;
        }
        
        if ($right - $left - 1 > $this->maxLen) {
            $this->maxLen = $right - $left - 1;
            $this->start = $left + 1;
        }
    }
}