<?php
/**
 * Custommodule Design List Controller.
 * @category  Custommodule
 * @package   Custommodule_Design
 * @author    Custommodule
 * @copyright Copyright (c) 2010-2017 Custommodule Software Private Limited (https://Custommodule.com)
 * @license   https://store.Custommodule.com/license.html
 */
namespace Custommodule\Design\Controller\Adminhtml\Grid;

use Magento\Framework\Controller\ResultFactory;

class AddRow extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Custommodule\Design\Model\GridFactory
     */
    private $GridFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \Custommodule\Design\Model\GridFactory $GridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Custommodule\Design\Model\GridFactory $GridFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->GridFactory = $GridFactory;
    }

    /**
     * Mapped Design List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->GridFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getDesignerId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('design/grid/rowdata');
                return;
            }
        }

        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Designer ').$rowTitle : __('Add New Designer');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Custommodule_Design::add_row');
    }
}
