<?php

namespace Bs\Blog\Block;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Bs\Blog\Model\Post;
use Bs\Blog\Model\PostFactory;
use Bs\Blog\Controller\Index\View as ViewAction;

class View extends Template
{
    protected $_coreRegistry;
    protected $_post = null;
    protected $_postFactory;

    public function __construct(Context $context, Registry $registry, PostFactory $postFactory, array $data = [])
    {
        $this->_coreRegistry = $registry;
        $this->_postFactory = $postFactory;
        parent::__construct($context, $data);
    }

    public function getPost()
    {
        if($this->_post == null){
            $post = $this->_postFactory->create();
            $post->load($this->_getPostId());

            if(!$post->getId()){
                throw new LocalizedException(__('Post not found.'));
            }

            $this->_post = $post;
        }
        return $this->_post;
    }

    protected function _getPostId()
    {
        return (int) $this->_coreRegistry->registry(
            ViewAction::REGISTRY_KEY_POST_ID
        );
    }
}