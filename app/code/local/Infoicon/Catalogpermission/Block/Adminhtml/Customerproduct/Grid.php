<?php

class Infoicon_Catalogpermission_Block_Adminhtml_Customerproduct_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("customerproductGrid");
				$this->setDefaultSort("id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("catalogpermission/customerproduct")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("id", array(
				"header" => Mage::helper("catalogpermission")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "id",
				));
                
				$this->addColumn("customer_id", array(
				"header" => Mage::helper("catalogpermission")->__("Customer"),
				"index" => "customer_id",
				"type"      => "options",
				"options"    => Mage::getModel('catalogpermission/config_customer_source_list')->getUserList(),
				
				));
				
				$this->addColumn("product_id", array(
				"header" => Mage::helper("catalogpermission")->__("Product IDs"),
				"index" => "product_id",
				));
				
				
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('id');
			$this->getMassactionBlock()->setFormFieldName('ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_customerproduct', array(
					 'label'=> Mage::helper('catalogpermission')->__('Remove Customer'),
					 'url'  => $this->getUrl('*/adminhtml_customerproduct/massRemove'),
					 'confirm' => Mage::helper('catalogpermission')->__('Are you sure?')
				));
			return $this;
		}
			

}