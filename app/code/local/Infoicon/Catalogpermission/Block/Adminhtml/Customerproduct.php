<?php


class Infoicon_Catalogpermission_Block_Adminhtml_Customerproduct extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_customerproduct";
	$this->_blockGroup = "catalogpermission";
	$this->_headerText = Mage::helper("catalogpermission")->__("Customerproduct Manager");
	$this->_addButtonLabel = Mage::helper("catalogpermission")->__("Add New Item");
	parent::__construct();
	
	}

}