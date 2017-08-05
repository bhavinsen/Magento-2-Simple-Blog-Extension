<?php

namespace Bs\Blog\Block\Adminhtml\Post\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;

class Info extends Generic implements TabInterface
{
    protected $_wysiwygConfig;    

    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        array $data = []
    ){        
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareLayout()
    {
          $model = $this->_coreRegistry->registry('blog_post');

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('post_');
        $form->setFieldNameSuffix('post');
 
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General')]
        );
 
        if ($model->getId()) {
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'post_id']
            );
        }
        $fieldset->addField(
            'title',
            'text',
            [
                'name'        => 'title',
                'label'    => __('Title'),
                'required'     => true
            ]
        );      
        $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'content',
            'editor',
            [
                'name'        => 'content',
                'label'    => __('Content'),
                'required'     => true,
                'config'    => $wysiwygConfig
            ]
        );
 
        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);
 
        return parent::_prepareForm();          
    }

    public function getTabLabel()
    {
        return __('Post Info');
    }
 
    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Post Info');
    }
 
    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }
 
    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }    
}