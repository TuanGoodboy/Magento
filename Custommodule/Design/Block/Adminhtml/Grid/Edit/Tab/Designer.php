<?php
/**
 * Custommodule_Design Add New Row Form Admin Block.
 * @category    Custommodule
 * @package     Custommodule_Design
 * @author      Custommodule Software Private Limited
 *
 */
namespace Custommodule\Design\Block\Adminhtml\Grid\Edit\Tab;
use Custommodule\Design\Block\Adminhtml\Renderer\Image;
use Custommodule\Design\Helper\Image as ImageHelper;
/**
 * Adminhtml Add New Row Form.
 */
class Designer extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    /**
     * @var ImageHelper
     */
    protected $imageHelper;
    /**
     * @var type
     */
    protected $type;
    /**
     * @param \Magento\Backend\Block\Template\Context $context,
     * @param \Magento\Framework\Registry $registry,
     * @param \Magento\Framework\Data\FormFactory $formFactory,
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
     * @param \Custommodule\Design\Model\Status $options,
     * @param \Custommodule\Design\Model\Type $type,
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Custommodule\Design\Model\Status $options,
        \Custommodule\Design\Model\Type $type,
        ImageHelper $imageHelper,
        array $data = []
    ) {
        $this->_options = $options;
        $this->_type = $type;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
        $this->imageHelper = $imageHelper;
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        // $id= 123;
        // $valueTitle = $valueName = '';
        // if ($id) {
        //     $valueTitle = 'test';
        //     $valueName = 'text';
        // }
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create();
        //     ['data' => [
        //                     'id' => 'edit_form',
        //                     'enctype' => 'multipart/form-data',
        //                     'action' => $this->getData('action'),
        //                     'method' => 'post'
        //                 ]
        //     ]
        // );

        $form->setHtmlIdPrefix('designer_');
        $form->setFieldNameSuffix('designer');
        if ($model && $model->getDesignerId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Designer'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('designer_id', 'hidden', ['name' => 'designer_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add New Designer'), 'class' => 'fieldset-wide']
            );
        }
        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Page Title'),
                'id' => 'title',
                'title' => __('Page Title'),
                'class' => 'required-entry',
                'required' => true,
                // 'value' => $valueTitle
            ]
        );
        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Designer Name'),
                'id' => 'name',
                'title' => __('Designer Name'),
                'class' => 'required-entry',
                'required' => true,
                // 'value' => $valueName
            ]
        );
        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);
        $fieldset->addField(
            'instruction',
            'editor',
            [
                'name' => 'instruction',
                'label' => __('instruction'),
                'style' => 'height:10em;',
                'required' => true
            ]
        );
        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Status'),
                'id' => 'status',
                'title' => __('Status'),
                'values' => $this->_options->getOptionArray(),
                'class' => 'status',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'profile_image', 
            Image::class, 
            [
            'name' => 'profile_image',
            'label' => __('Profile Image'),
            'title' => __('Profile Image'),
            'path' => $this->imageHelper->getBaseMediaPath(ImageHelper::TEMPLATE_MEDIA_TYPE_DESIGNER)
            ]
        );
        $fieldset->addField(
            'type',
            'select',
            [
                'name' => 'type',
                'label' => __('Type'),
                'id' => 'type',
                'title' => __('Type'),
                'values' => $this->_type->toOptionArray(),
                'class' => 'type',
                'required' => true,
            ]
        );

        if ($model) {
            $form->setValues($model->getData());
        }
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
