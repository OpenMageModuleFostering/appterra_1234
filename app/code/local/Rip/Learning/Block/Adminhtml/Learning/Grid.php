<?php
  
class Rip_Learning_Block_Adminhtml_Learning_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('learning_Grid');
        // This is the primary key of the database
        $this->setDefaultSort('apptera_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
  
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('learning/learning')->getCollection();  
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
  
    protected function _prepareColumns()
    {
        $this->addColumn('apptera_id', array(
            'header'    => Mage::helper('learning')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'apptera_id',
        ));
  
        $this->addColumn('link', array(
            'header'    => Mage::helper('learning')->__('Link'),
            'align'     =>'left',
            'index'     => 'link',
        ));
  
        /*
        $this->addColumn('content', array(
            'header'    => Mage::helper('<module>')->__('Item Content'),
            'width'     => '150px',
            'index'     => 'content',
        ));
        */
  
        
  
          
  
  
        
  
        return parent::_prepareColumns();
    }
  
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
  
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
  
  
} 