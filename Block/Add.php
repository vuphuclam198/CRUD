<?php
 
namespace AHT\CRUD\Block;
 
use Magento\Framework\View\Element\Template;
 
class Add extends \Magento\Framework\View\Element\Template
{
    protected $pageFactory;

    public function __construct(
         \Magento\Framework\View\Element\Template\Context $context,
         \Magento\Framework\View\Result\PageFactory $pageFactory
         )
    {
         $this->pageFactory = $pageFactory;
         return parent::__construct($context);
    }

    public function execute()
    {
         return $this->pageFactory->create();
    }
}