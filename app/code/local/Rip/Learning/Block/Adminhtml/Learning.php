<?php
class Rip_Learning_Block_Adminhtml_Learning extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
	  
    $this->_controller = 'adminhtml_learning';
    $this->_blockGroup = 'learning';
    $this->_headerText = Mage::helper('learning')->__('Work Under Process');
    $this->_addButtonLabel = Mage::helper('learning')->__('Add Item');
    parent::__construct();
  }
}




