<?php

namespace Bs\Blog\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;
use Magento\Backend\Block\Widget\Context;
class Post extends Container
{
    public function __construct(Context $context)
    {
        $this->_controller = 'adminhtml_post';
        $this->_blockGroup = 'Bs_Blog';
        $this->_headerText = 'Posts';
        $this->_addButtonLabel = __('Create New Post');
        parent::__construct($context);
    }
}