<?php

namespace Bs\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Bs\Blog\Model\ResourceModel\Post\Collection as PostCollection;
use Bs\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use Bs\Blog\Model\Post;

class Posts extends Template
{
    protected $_postCollectionFactory = null;

    public function __construct(Context $context, PostCollectionFactory $postCollectionFactory, array $data = [])
    {
        $this->_postCollectionFactory = $postCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getPosts()
    {
        $postCollection = $this->_postCollectionFactory->create();
        $postCollection->addFieldToSelect('*')->load();
        return $postCollection->getItems();
    }

    public function getPostUrl($post)
    {
        return '/magento/blog/index/view/id/'.$post->getId();
    }
}