<?php
namespace Custommodule\Design\Controller\Adminhtml\Post;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Custommodule\Design\Model\ResourceModel\Post\CollectionFactory;

class MassDelete extends Action
{
    public $collectionFactory;
    public $filter;
    protected $postFactory;
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        \Custommodule\Design\Model\PostFactory $postFactory
    ) {
        $this->filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->_collectionFactory->create());
            $count = 0;
            foreach ($collection as $model) {
                $model = $this->postFactory->create()->load($model->getId());
                $model->delete();
                $count++;
            }
            $this->messageManager->addSuccess(__('A total of %1 Designs have been deleted.', $count));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Custommodule_Design::delete');
    }
}