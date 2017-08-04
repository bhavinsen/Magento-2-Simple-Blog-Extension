<?php

namespace Bs\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Bs\Blog\Api\Data\PostInterface;

class Post extends AbstractModel implements PostInterface, IdentityInterface
{
    const CACHE_TAG = 'bs_blog_post';

    protected function _construct()
    {
        $this->_init('Bs\Blog\Model\ResourceModel\Post');
    }

    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getId()
    {
        return $this->getData(self::POST_ID);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set Content
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set Created At
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::POST_ID, $id);
    }    
}