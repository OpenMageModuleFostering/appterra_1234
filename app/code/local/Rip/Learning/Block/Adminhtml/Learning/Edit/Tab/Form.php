<?php
  
class Rip_Learning_Block_Adminhtml_Learning_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{

	
    protected function _prepareForm()
    {
		
    $form = new Varien_Data_Form(
		array(
'id' => 'edit_form',
'action' => $this->getUrl('*/*/save' , array('id' => $this->getRequest()->getParam('id'))),
'method' => 'post',
)
		
		
		);
		
		
        
		
		
        $fieldset = $form->addFieldset('learning_form', array('legend'=>Mage::helper('learning')->__('Enter Ftp Detail')));
        
		 $model = Mage::getModel('learning/learning')->load(1);
        $link = $model->getHost();
		$username = $model->getUsername();
		$password = $model->getPassword();
		$filename = $model->getFilename();
		
        $fieldset->addField('host', 'text', array(
            'label'     => Mage::helper('learning')->__('FTP Host'),
            'class'     => 'required-entry',
            'required'  => true,
			'value'     => $link,
            'name'      => 'Host',
        ));
  
 
 $fieldset->addField('username', 'text', array(
            'label'     => Mage::helper('learning')->__('FTP Username'),
            'class'     => 'required-entry',
            'required'  => true,
			'value'     => $username,
            'name'      => 'Username',
        ));
 
 
 $fieldset->addField('password', 'password', array(    
            'label'     => Mage::helper('learning')->__('FTP Password'),
            'class'     => 'required-entry',
            'required'  => true,
			'value'     => $password,
            'name'      => 'Password',
        ));
 
 
 $fieldset->addField('filename', 'text', array(
            'label'     => Mage::helper('learning')->__('File Path'),
            'class'     => 'required-entry',
            'required'  => true,
			'value'     => $filename,
            'name'      => 'Filename',
			'after_element_html' => '</br>Note : <small>Strictly recommend to use the file path as (public_html/...)</small>',
        ));
 
  
  
  
       $fieldset->addField('submit', 'submit', array(
          'value'  => 'Submit',
          'after_element_html' => '<small></small>',
		  'onclick' => "setLocation('{$this->getUrl('*/learning/save')}')",
		  'class' => 'form-button', 			  
          'tabindex' => 2
        ));
	   
	  
        
        if ( Mage::getSingleton('adminhtml/session')->getlearningData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getlearningData());
            Mage::getSingleton('adminhtml/session')->setlearningData(null);
        } elseif ( Mage::registry('learning_data') ) {
            $form->setValues(Mage::registry('learning_data')->getData());
        }
		
		
		$form->setUseContainer(true);
                $this->setForm($form);
		
		
        return parent::_prepareForm();
    }
	
	
	
	
	
	
	
} 