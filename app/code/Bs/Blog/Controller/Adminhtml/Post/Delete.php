<?php

namespace Bs\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Bs\Blog\Model\Post;
use Bs\Blog\Model\PostFactory;

class Delete extends Action
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
      $postId = (int) $this->getRequest()->getParam('id');
 
      if ($postId) {
         /** @var $newsModel \Mageworld\SimpleNews\Model\News */
         $postModel = $this->_postFactory->create();
         $postModel->load($postId);
 
         // Check this news exists or not
         if (!$postModel->getId()) {
            $this->messageManager->addError(__('This post no longer exists.'));
         } else {
               try {
                  // Delete news
                  $postModel->delete();
                  $this->messageManager->addSuccess(__('The post has been deleted.'));
 
                  // Redirect to grid page
                  $this->_redirect('*/*/');
                  return;
               } catch (\Exception $e) {
                   $this->messageManager->addError($e->getMessage());
                   $this->_redirect('*/*/edit', ['id' => $postModel->getId()]);
               }
            }
      }
   }        
}