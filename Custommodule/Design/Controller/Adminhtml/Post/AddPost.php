<?php
/**
 * Custommodule Design List Controller.
 * @category  Custommodule
 * @package   Custommodule_Design
 * @author    Custommodule
 * @copyright Copyright (c) 2010-2017 Custommodule Software Private Limited (https://Custommodule.com)
 * @license   https://store.Custommodule.com/license.html
 */
namespace Custommodule\Design\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;

class AddPost extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Custommodule\Design\Model\PostFactory
     */
    private $PostFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \Custommodule\Design\Model\PostFactory $PostFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Custommodule\Design\Model\PostFactory $PostFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->PostFactory = $PostFactory;
    }

    /**
     * Mapped Design List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->PostFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getPageId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('design/post/rowdata');
                return;
            }
        }
        $this->coreRegistry->register('row_post', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Designs ').$rowTitle : __('Add New Designs');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Custommodule_Design::add_post');
    }
}
