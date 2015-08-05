<?php

## Fetch products with status "Enabled" and visible in both catalog & search.
$products = Mage::getModel('catalog/product')->getCollection();
$products->addAttributeToSelect('*');
$products->addAttributeToFilter('status', 1);
$products->addAttributeToFilter('visibility', 4);

## Get categories of only enabled and visible products
$categories = array();
$products = Mage::getModel('catalog/product')->getCollection()->addAttributeToFilter('visibility', 4);
foreach($products as $product) {
  foreach($product->getCategoryIds() as $cat) {
     $categories[] = $cat;
  }
}
$categories = array_values(array_unique($categories));

?>
