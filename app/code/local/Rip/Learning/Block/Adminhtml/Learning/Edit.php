<?php

class Rip_Learning_Block_Adminhtml_Learning_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                
        $this->_objectId = 'id';
        $this->_blockGroup = 'learning';
        $this->_controller = 'adminhtml_learning';
  
       /* $this->_updateButton('save', 'label', Mage::helper('learning')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('learning')->__('Delete Item'));
		
		*/
		
		$this->_removeButton('save');
$this->_removeButton('back');
$this->_removeButton('reset');
		
		
		$this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Refresh Data'),
            'onclick' => "setLocation('{$this->getUrl('*/learning/refresh')}')",
            'class'     => 'save',
        ), -100);

		
		
		
    }

    public function getHeaderText()
    {
       if( Mage::registry('learning_data') && Mage::registry('learning_data')->getId() ) {
            return Mage::helper('learning')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('learning_data')->getTitle()));
        } else {
            return Mage::helper('learning')->__('Appterra');
        }
    }
}