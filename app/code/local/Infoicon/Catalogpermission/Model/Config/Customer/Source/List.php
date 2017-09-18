<?php
class Infoicon_Catalogpermission_Model_Config_Customer_Source_List
{
    public function toOptionArray()
    {
        // Build Option Array
        $optionArray = array();
		$collection = Mage::getModel('customer/customer')
                        ->getCollection()
                        ->addAttributeToSelect('*');
        foreach ($collection as $customer) {
		//echo "<pre>"; print_r($customer->getData());
            $optionArray[] = array(
                'value' => $customer->getId(),
                'label' =>$customer->getFirstname().' -( '.$customer->getEmail().' )'
            );
        }
		

        // Finished
        return $optionArray;
    }
	
	public function getUserList()
	{
	
		$collection = Mage::getModel('customer/customer')
                        ->getCollection()
                        ->addAttributeToSelect('*');
		
	    $optionArray = array();
		foreach ($collection as $customer) {
		  //echo "<pre>"; print_r($customer->getData());
		   $optionArray[$customer->getId()] = $customer->getEmail();
		}
		
		return $optionArray;
	}
}