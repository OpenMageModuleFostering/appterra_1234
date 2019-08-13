<?php
 
class Rip_Learning_Model_Resource_Learning_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('learning/learning');
    }
}