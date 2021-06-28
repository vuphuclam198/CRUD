<?php
namespace AHT\CRUD\Controller\Post;
 
use Magento\Framework\App\Filesystem\DirectoryList;
 
class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_postFactory;
    protected $request;
    protected $cachePool;
    protected $cacheTypeList;
 
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\CRUD\Model\PostFactory $postFactory,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $cachePool
        )
    {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        $this->request = $request;
        $this->cachePool = $cachePool;
        $this->cacheTypeList = $cacheTypeList;

        return parent::__construct($context);
    }


    public function execute()
    {

    $post = $this->_postFactory->create();
    $id = $this->request->getParam('id');

    if(!empty($id) && isset($id))
    {
        $post->setId($id);
        $post->setName($_POST['name']);
        $post->setContent($_POST['content']);
        $post->save();
        $this->messageManager->addSuccess(__('Update thành công'));
    }
    else
    {
        $post->setName($_POST['name']);
        $post->setContent($_POST['content']);
        $post->save();
        $this->messageManager->addSuccess(__('Add thành công'));
    }
    $this->cleanCache();
    return $this->_redirect('crud/post/index');
    }

    // lấy giá trị request khi submit
    public function getPost()
    {
        return $this->request->getPostValue();
    }

    // hàm clean cache
    public function cleanCache()
    {
        $types = array('config','layout','block_html','collections','reflection','db_ddl','eav','config_integration','config_integration_api','full_page','translate','config_webservice');
    
        foreach ($types as $type) {
            $this->cacheTypeList->cleanType($type);
        }
        foreach ($this->cachePool as $cachePool) {
            $cachePool->getBackend()->clean();
        }
    }
}
?>
