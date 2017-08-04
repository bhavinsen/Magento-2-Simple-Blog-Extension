<?php

namespace Bs\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Bs\Blog\Model\Post', 'Bs\Blog\Model\ResourceModel\Post');
    }
}