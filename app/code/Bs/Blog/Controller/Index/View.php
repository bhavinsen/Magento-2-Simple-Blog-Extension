<?php

namespace Bs\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

class View extends Action
{
    const REGISTRY_KEY_POST_ID = 'bs_blog_post_id';

    protected $_coreRegistry;
    protected $_resultPageFactory;

    public function __construct(Context $context, Registry $registry, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->_coreRegistry = $registry;
        $this->_resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $this->_coreRegistry->register(self::REGISTRY_KEY_POST_ID, (int) $this->_request->getParam('id'));
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}