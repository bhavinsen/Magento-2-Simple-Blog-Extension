<?php

namespace Bs\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Bs\Blog\Model\Post;
use Bs\Blog\Model\PostFactory;

class Save extends Action
{
    protected $_resultPageFactory;
    protected $_postFactory;
    protected $_coreRegistry;

    public function __construct(Context $context, PageFactory $resultPageFactory, PostFactory $postFactory, Registry $coreRegistry)
    {        
        $this->_resultPageFactory = $resultPageFactory;
        $this->_postFactory = $postFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

   public function execute()
   {
      $isPost = $this->getRequest()->getPost();
      if ($isPost) {
         $postModel = $this->_postFactory->create();
         $postId = $this->getRequest()->getParam('id');;   
         if ($postId) {
            $postModel->load($postId);
         }

         $formData = $this->getRequest()->getParam('post');
         $postModel->setData($formData);
         
         try {
            // Save news
            $postModel->save();
 
            // Display success message
            $this->messageManager->addSuccess(__('The post has been saved.'));
 
            // Check if 'Save and Continue'
            if ($this->getRequest()->getParam('back')) {
               $this->_redirect('*/*/edit', ['id' => $postModel->getId(), '_current' => true]);
               return;
            }
 
            // Go to grid page
            $this->_redirect('*/*/');
            return;
         } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
         }
 
         $this->_getSession()->setFormData($formData);
         $this->_redirect('*/*/edit', ['id' => $postId]);
      }
   } 
}