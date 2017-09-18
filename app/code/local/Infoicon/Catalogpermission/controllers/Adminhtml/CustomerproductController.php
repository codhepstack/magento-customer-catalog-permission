<?php

class Infoicon_Catalogpermission_Adminhtml_CustomerproductController extends Mage_Adminhtml_Controller_Action
{
		protected function _isAllowed()
		{
		//return Mage::getSingleton('admin/session')->isAllowed('catalogpermission/customerproduct');
			return true;
		}

		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("catalogpermission/customerproduct")->_addBreadcrumb(Mage::helper("adminhtml")->__("Customerproduct  Manager"),Mage::helper("adminhtml")->__("Customerproduct Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Catalogpermission"));
			    $this->_title($this->__("Manager Customerproduct"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Catalogpermission"));
				$this->_title($this->__("Customerproduct"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("catalogpermission/customerproduct")->load($id);
				if ($model->getId()) {
					Mage::register("customerproduct_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("catalogpermission/customerproduct");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Customerproduct Manager"), Mage::helper("adminhtml")->__("Customerproduct Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Customerproduct Description"), Mage::helper("adminhtml")->__("Customerproduct Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("catalogpermission/adminhtml_customerproduct_edit"))->_addLeft($this->getLayout()->createBlock("catalogpermission/adminhtml_customerproduct_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("catalogpermission")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("Catalogpermission"));
		$this->_title($this->__("Customerproduct"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("catalogpermission/customerproduct")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("customerproduct_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("catalogpermission/customerproduct");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Customerproduct Manager"), Mage::helper("adminhtml")->__("Customerproduct Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Customerproduct Description"), Mage::helper("adminhtml")->__("Customerproduct Description"));


		$this->_addContent($this->getLayout()->createBlock("catalogpermission/adminhtml_customerproduct_edit"))->_addLeft($this->getLayout()->createBlock("catalogpermission/adminhtml_customerproduct_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						

						$model = Mage::getModel("catalogpermission/customerproduct")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->setProductId(implode(',',$this->getRequest()->getPost('product_id')))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Customerproduct was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setCustomerproductData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setCustomerproductData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("catalogpermission/customerproduct");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("catalogpermission/customerproduct");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'customerproduct.csv';
			$grid       = $this->getLayout()->createBlock('catalogpermission/adminhtml_customerproduct_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'customerproduct.xml';
			$grid       = $this->getLayout()->createBlock('catalogpermission/adminhtml_customerproduct_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
