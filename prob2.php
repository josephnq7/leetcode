<?php
class TreeNode {
      public $val = null;
      public $left = null;
      public $right = null;
      function __construct($val = 0, $left = null, $right = null) {
          $this->val = $val;
          $this->left = $left;
          $this->right = $right;
      }
 }

 $root1 = new TreeNode(1);
 $node12 = new TreeNode(2);
 $node13 = new TreeNode(3);
 $root1->left = $node12;
 $root1->right = $node13;

 $root2 = new TreeNode(1);
$node22 = new TreeNode(2);
$node23 = new TreeNode(3);
$root2->right = $node22;
$root2->left = $node23;

leafSimilar($root1, $root2);

function leafSimilar($root1, $root2) {
    $a = '';
    $b = '';
    getLeaf($root1, $a);
//    echo $leaf1;
    getLeaf($root2, $b);
//    echo $leaf2;
//    return $leaf1 === $leaf2;
    echo $a . "===" . $b;
}

function getLeaf($root, &$s) {
    if ($root == null)
        return;

    // If node is leaf node, print its data
    if ($root->left == null &&
        $root->right == null)
    {
        $s .= $root->val;
        return;
    }

    // If left child exists, check for leaf
    // recursively
    if ($root->left != null)
        getLeaf($root->left, $s);

    // If right child exists, check for leaf
    // recursively
    if ($root->right != null)
        getLeaf($root->right, $s);
}