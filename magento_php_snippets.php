<?php
## Visibility list as defined in Magento
## Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE ==> 1
## Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG ==> 2
## Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_SEARCH ==> 3
## Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH ==> 4

## Fetch products with status "Enabled" and visible in both catalog & search.
$visibility = array(
  Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
  Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
);
$products = Mage::getModel('catalog/product')->getCollection();
$products->addAttributeToSelect('*');
$products->addAttributeToFilter('status', 1);
$products->addAttributeToFilter('visibility', 4);
## or ##
$products->addAttributeToFilter('visibility', $visibility);

## Get categories of only enabled and visible products
$categories = array();
$products = Mage::getModel('catalog/product')->getCollection();
$products->addAttributeToFilter('status', 1);
$products->addAttributeToFilter('visibility', 4);
## or ##
$products->addAttributeToFilter('visibility', $visibility);
foreach($products as $product) {
  foreach($product->getCategoryIds() as $cat) {
     $categories[] = $cat;
  }
}
$categories = array_values(array_unique($categories));

## Display truncated descriptions and names in templates
echo Mage::helper('core/string')->truncate($string, $length);
## or ##
$strHelper = Mage::helper('core/string');
echo $strHelper->truncate($string, $length);

## Get referer/back url in Magento
Mage::app()->getRequest()->getServer('HTTP_REFERER');

## Redirect within Magento stores only
## $this->_redirect('module/controller/action');
$this->_redirect('customer/account/login');
$this->_redirect('*/*/success');
## First '*' means current module
## Second '*' means current controller
## Third "success" means current controller's action.

## Redirect to both external urls and Magento urls
$this->_redirectUrl('http://anydomain.com');
$this->_redirectUrl('customer/account/login'); ## This also works

## Check if customer logged in or not:
if(!Mage::getSingleton('customer/session')->isLoggedIn()) {
  //not logged in
} else {
  // logged in
}

## Get current url in Magento
$currurl = Mage::helper('core/url')->getCurrentUrl();
