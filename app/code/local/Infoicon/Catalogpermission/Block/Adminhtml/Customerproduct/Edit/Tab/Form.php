<?php
class Infoicon_Catalogpermission_Block_Adminhtml_Customerproduct_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("catalogpermission_form", array("legend"=>Mage::helper("catalogpermission")->__("Item information")));

				
						//$fieldset->addField("product_id", "text", array(
//						"label" => Mage::helper("catalogpermission")->__("Product IDs"),
//						"name" => "product_id",
//						));
						
						$fieldset->addField('product_id', 'multiselect',
							array(
								"label" => Mage::helper("catalogpermission")->__("Product IDs"),
								'class' => 'required-entry',
								'required' => true,
								'name' => 'product_id[]',
								'values'    => Mage::getModel('catalogpermission/config_product_source_list')->toOptionArray(),
						
							));
						
						$fieldset->addField('customer_id', 'select',
							array(
								"label" => Mage::helper("catalogpermission")->__("Customer ID"),
								'class' => 'required-entry',
								'required' => true,
								'name' => 'customer_id',
								'values'    => Mage::getModel('catalogpermission/config_customer_source_list')->toOptionArray(),
						
							));
						
					

				if (Mage::getSingleton("adminhtml/session")->getCustomerproductData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getCustomerproductData());
					Mage::getSingleton("adminhtml/session")->setCustomerproductData(null);
				} 
				elseif(Mage::registry("customerproduct_data")) {
				    $form->setValues(Mage::registry("customerproduct_data")->getData());
				}
				return parent::_prepareForm();
		}
}
