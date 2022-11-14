<?php
namespace Webkul\BlogManager\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class BlogEdit extends Template
{
    public $blogFactory;

    public function __construct(Context $context, \Webkul\BlogManager\Model\BlogFactory $blogFactory,  array $data=[])
    {
        $this->blogFactory = $blogFactory;
        parent::__construct($context, $data);
    }

    public function getBlogs()
    {
        $blogId = $this->getRequest()->getParam('id');
        return $this->blogFactory->create()->load($blogId);
    }
}