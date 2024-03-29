 <?php
  
class Rip_Learning_Block_Adminhtml_Learning_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
  
    public function __construct()
    {
        parent::__construct();
        $this->setId('learning_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('learning')->__('News Information'));
    }
  
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('learning')->__('Item Information'),
            'title'     => Mage::helper('learning')->__('Item Information'),
            'content'   => $this->getLayout()->createBlock('learning/adminhtml_learning_edit_tab_form')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}