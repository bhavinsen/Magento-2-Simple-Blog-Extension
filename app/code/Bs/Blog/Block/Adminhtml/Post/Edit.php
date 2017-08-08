<?php

namespace Bs\Blog\Block\Adminhtml\Post;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class Edit extends Container
{
    protected $_coreRegistry = null;

    public function __construct(Context $context, Registry $registry, array $data = [])
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_controller = "adminhtml_post";
        $this->_blockGroup = "Bs_Blog";

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save'));
        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' =>[
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target'=> '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('delete', 'label', __('Delete'));
    }

    public function getHeaderText()
    {
        $postRegistry = $this->_coreRegistry->registry('blog_post');        
        if($postRegistry->getId()){
            $postTitle = $this->escapeHtml($postRegistry->getTitle());
            return __("Edit Post '%id'", $postTitle);
        }else{
            return __('Add Post');
        }
    }

    public function _prepareLayout()
    {
        $this->_formScripts[] = "
            function toogleEditor(){
                if (tinyMCE.getInstanceById('post_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'post_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'post_content');
                }                
            }
        ";

        return parent::_prepareLayout();
    }
}