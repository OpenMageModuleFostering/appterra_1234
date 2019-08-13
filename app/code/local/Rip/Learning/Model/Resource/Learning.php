<?php
 
class Rip_Learning_Model_Resource_Learning extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {   
        $this->_init('learning/learning', 'apptera_id');
    }
}