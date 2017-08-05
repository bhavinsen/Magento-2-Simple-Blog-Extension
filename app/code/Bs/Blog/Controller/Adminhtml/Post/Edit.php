<?php

namespace Bs\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Bs\Blog\Model\PostFactory;

class Edit extends Action
{
    protected $_resultPageFactory;
    protected $_postFactory;
    protected $_coreRegistry;

    public function __construct(Context $context, PageFactory $resultPageFactory, PostFactory $postFactory, Registry $coreRegistry)
    {
        parent::__construct($context);
        $this->__resultPageFactory = $resultPageFactory;
        $this->_postFactory = $postFactory;
        $this->_coreRegistry = $coreRegistry;
    }
    
    public function execute()
    {
        $postId = $this->getRequest()->getParam('id');

        $model = $this->_postFactory->create();
        if($postId){
            $model->load($postId);
            if(!$model->getId()){
                $this->messageManager->addError(__('This post no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $data = $this->_session->getPostData();
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('blog_post', $model);
 
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Bs_Blog::post');
        $resultPage->getConfig()->getTitle()->prepend(__('Simple Post'));
 
        return $resultPage;        
    }    
}