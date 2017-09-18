<?php
class Infoicon_Catalogpermission_Block_Adminhtml_Customerproduct_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("customerproduct_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("catalogpermission")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("catalogpermission")->__("Item Information"),
				"title" => Mage::helper("catalogpermission")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("catalogpermission/adminhtml_customerproduct_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
