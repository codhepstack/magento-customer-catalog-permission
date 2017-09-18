<?php
class Infoicon_Catalogpermission_Block_Catalog_Product_List extends Mage_Catalog_Block_Product_List
{
	 protected function _getProductCollection()
    {
		
		$ifEnable = Mage::getStoreConfig('catalogpermission/catalog_permission/is_enable');
		
		if (is_null($this->_productCollection)) {
            $layer = $this->getLayer();
            /* @var $layer Mage_Catalog_Model_Layer */
            if ($this->getShowRootCategory()) {
                $this->setCategoryId(Mage::app()->getStore()->getRootCategoryId());
            }

            // if this is a product view page
            if (Mage::registry('product')) {
                // get collection of categories this product is associated with
                $categories = Mage::registry('product')->getCategoryCollection()
                    ->setPage(1, 1)
                    ->load();
                // if the product is associated with any category
                if ($categories->count()) {
                    // show products from this category
                    $this->setCategoryId(current($categories->getIterator()));
                }
            }

            $origCategory = null;
            if ($this->getCategoryId()) {
                $category = Mage::getModel('catalog/category')->load($this->getCategoryId());
                if ($category->getId()) {
                    $origCategory = $layer->getCurrentCategory();
                    $layer->setCurrentCategory($category);
                    $this->addModelTags($category);
                }
            }
			
            $this->_productCollection = $layer->getProductCollection();
			$ifEnable = Mage::getStoreConfig('catalogpermission/catalog_permission/is_enable');
			if($ifEnable){
			/* Get Product IDs based on user login  */
				if(Mage::getSingleton('customer/session')->isLoggedIn()) {
					$customerData = Mage::getSingleton('customer/session')->getCustomer();
				
				$pIds = Mage::getModel('catalogpermission/customerproduct')->getCollection()->addFieldToFilter('customer_id', $customerData->getId());
				
				
				foreach($pIds->getData() as $rowData){
					$pArray = explode(",",$rowData['product_id']);
				}
				//print_r($pArray); exit;
				
				$this->_productCollection->addAttributeToFilter('entity_id', array('in' => $pArray));
				//echo "<pre>"; print_r($this->_productCollection->getData()); exit;
				}
				else {
				$pArray = 0;
				$this->_productCollection->addAttributeToFilter('entity_id', array('in' => $pArray));
				}
			}
            $this->prepareSortableFieldsByCategory($layer->getCurrentCategory());

            if ($origCategory) {
                $layer->setCurrentCategory($origCategory);
            }
        }

        return $this->_productCollection;
    }
}
			