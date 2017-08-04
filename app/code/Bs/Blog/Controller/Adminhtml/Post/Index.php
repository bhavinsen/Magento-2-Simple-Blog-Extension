<?php

namespace Bs\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
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
        $resultPage->setActiveMenu('Bs_Blog::post');
        $resultPage->getConfig()->getTitle()->prepend((__('Posts')));

        //Add bread crumb
        $resultPage->addBreadcrumb(__('Bs'), __('Bs'));
        $resultPage->addBreadcrumb(__('Blog'), __('Manage Blogs'));        
        return $resultPage;
    }
}