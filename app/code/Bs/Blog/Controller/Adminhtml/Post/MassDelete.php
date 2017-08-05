<?php

namespace Bs\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Bs\Blog\Model\PostFactory;

class MassDelete extends Action
{
    public function __construct(Context $context, PageFactory $resultPageFactory, PostFactory $postFactory, Registry $coreRegistry)
    {
        parent::__construct($context);
        $this->__resultPageFactory = $resultPageFactory;
        $this->_postFactory = $postFactory;
        $this->_coreRegistry = $coreRegistry;
    }

   public function execute()
   {
      // Get IDs of the selected news
      $postIds = $this->getRequest()->getParam('post');
 
        foreach ($postIds as $postId) {
            try {
               /** @var $newsModel \Mageworld\SimpleNews\Model\News */
                $postModel = $this->_postFactory->create();
                $postModel->load($postId)->delete();
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
 
        if (count($newsIds)) {
            $this->messageManager->addSuccess(
                __('A total of %1 record(s) were deleted.', count($postIds))
            );
        }
 
        $this->_redirect('*/*/index');
   }        
}