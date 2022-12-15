<?php
namespace Custommodule\Design\Controller\Adminhtml;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Custommodule\Design\Model\GridFactory;
 
class Designer extends Action
{
    protected $_coreRegistry;
    protected $_resultPageFactory;
    protected $_gridFactory;
 
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        GridFactory $gridFactory
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_gridFactory = $gridFactory;
 
    }
    public function execute()
    {
        $designerIds = $this->getRequest()->getParam('designer_id');
        $model = $this->_gridFactory->create();
 
        if ($designerIds) {
            $model->load($designerIds);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This news no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
 
        // Restore previously entered form data from session
        $data = $this->_session->getNewsData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('custommodule_design_grid', $model);
 
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('designer'));
 
        return $resultPage;
    }
 
    protected function _isAllowed()
    {
        return true;
    }
}