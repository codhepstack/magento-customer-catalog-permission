<?php
class Infoicon_Catalogpermission_Model_Mysql4_Customerproduct extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("catalogpermission/customerproduct", "id");
    }
}