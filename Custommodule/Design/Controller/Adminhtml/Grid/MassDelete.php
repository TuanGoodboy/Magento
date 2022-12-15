<?php
namespace Custommodule\Design\Controller\Adminhtml\Grid;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Custommodule\Design\Model\ResourceModel\Grid\CollectionFactory;

class MassDelete extends Action
{
    public $collectionFactory;
    public $filter;
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        \Custommodule\Design\Model\GridFactory $gridFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->gridFactory = $gridFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $count = 0;
            foreach ($collection as $model) {
                $model = $this->gridFactory->create()->load($model->getId());
                $model->delete();
                $count++;
            }
            $this->messageManager->addSuccess(__('A total of %1 Designer have been deleted.', $count));
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