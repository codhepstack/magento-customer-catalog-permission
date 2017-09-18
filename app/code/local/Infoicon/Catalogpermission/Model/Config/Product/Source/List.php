<?php
class Infoicon_Catalogpermission_Model_Config_Product_Source_List
{
    public function toOptionArray()
    {
        // Build Option Array
        $optionArray = array();
		$collection = Mage::getModel('catalog/product')
                        ->getCollection()
                        ->addAttributeToSelect('*');
        foreach ($collection as $product) {
		
		//echo "<pre>"; print_r($product->getData());
            $optionArray[] = array(
                'value' => $product->getId(),
                'label' =>$product->getName()
            );
        }
		

        // Finished
        return $optionArray;
    }
}