<?php

namespace Bs\Blog\Api\Data;

interface PostInterface
{
    const POST_ID = 'post_id';
    const TITLE   = 'title';
    const CONTENT = 'content';
    const CREATED_AT = 'creted_at';

    public function getTitle();
    public function getContent();
    public function getCreatedAt();
    public function getId();

    public function setTitle($title);
    public function setContent($content);
    public function setCreatedAt($createdAt);
    public function setId($postId);    
}