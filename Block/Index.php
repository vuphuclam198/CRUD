<?php
 
namespace AHT\CRUD\Block;
 
use Magento\Framework\View\Element\Template;
 
class Index extends \Magento\Framework\View\Element\Template
{
    protected $collectionFactory;
    protected $postFactory;

    public function __construct(Template\Context $context, 
    array $data = [],
    \AHT\CRUD\Model\ResourceModel\Post\CollectionFactory $collectionFactory,
    \AHT\CRUD\Model\PostFactory $postFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->postFactory = $postFactory;
        parent::__construct($context, $data);
    }
 
    public function getAll()
    {
        $all = $this->collectionFactory->create();
        return $all;
    }
}