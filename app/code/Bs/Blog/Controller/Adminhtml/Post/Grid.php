<?php

namespace Bs\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Grid extends Action
{
    protected $_resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->__resultPageFactory = $resultPageFactory;
    }

     public function execute()
     {
        $resultPage = $this->__resultPageFactory->create();
        return $resultPage;
     }    
}
//http://www.mage-world.com/blog/grid-and-form-in-magento-2-admin-panel-part-1.html