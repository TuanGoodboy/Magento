<?php
namespace Custommodule\Design\Block\Adminhtml\Grid\Edit;
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Framework\Registry $coreRegistry,
        array $data = []
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $jsonEncoder, $authSession, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('design_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Manage Designer'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'main',
            [
                'label' => __('Designer'),
                'content' => $this->getLayout()->createBlock(
                    'Custommodule\Design\Block\Adminhtml\Grid\Edit\Tab\Designer'
                )->toHtml(),
                'active' => true
            ]
        );
        $this->addTab(
            'designs',
            [
                'label' => __('Designs'),
                'content' => $this->getLayout()->createBlock(
                    'Custommodule\Design\Block\Adminhtml\Grid\Edit\Tab\Designs'
                )->toHtml(),
                'active' => true
            ]
        );

        return parent::_beforeToHtml();
    }
}