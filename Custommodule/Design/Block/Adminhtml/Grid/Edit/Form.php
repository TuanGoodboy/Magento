<?php
namespace Custommodule\Design\Block\Adminhtml\Grid\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

/**
 * Class Form
 * @package Custommodule\Design\Block\Adminhtml\Grid\Edit
 */
class Form extends Generic
{
    /**
     * @inheritdoc
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create([
            'data' => [
                'id' => 'edit_form',
                'action' => $this->getData('action'),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            ]
        ]);
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
