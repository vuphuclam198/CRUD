<?php
 
namespace AHT\CRUD\Block;
 
use Magento\Framework\View\Element\Template;
 
class Edit extends \Magento\Framework\View\Element\Template
{
    protected $_pageFactory;
    protected $_coreRegistry;
    protected $_postLoader;

    public function __construct(
         \Magento\Framework\View\Element\Template\Context $context,
         \Magento\Framework\View\Result\PageFactory $pageFactory,
         \Magento\Framework\Registry $coreRegistry,
         \AHT\CRUD\Model\PostFactory $postLoader,
         array $data = []
         )
    {
         $this->_pageFactory = $pageFactory;
         $this->_coreRegistry = $coreRegistry;
         $this->_postLoader = $postLoader;
         return parent::__construct($context,$data);
    }

    public function execute()
    {
         return $this->_pageFactory->create();
    }

    public function getEditRecord()
    {
        $id = $this->_coreRegistry->registry('editRecordId');
        $post = $this->_postLoader->create();
        $result = $post->load($id);
        
        return $result;
    }
}