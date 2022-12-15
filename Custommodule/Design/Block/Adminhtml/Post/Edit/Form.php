<?php
/**
 * Custommodule_Design Add New Row Form Admin Block.
 * @category    Custommodule
 * @package     Custommodule_Design
 * @author      Custommodule Software Private Limited
 *
 */
namespace Custommodule\Design\Block\Adminhtml\Post\Edit;
use Custommodule\Design\Block\Adminhtml\Renderer\Image;
use Custommodule\Design\Helper\Image as ImageHelper;
class Form extends \Magento\Backend\Block\Widget\Form\Generic
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
    protected $designer;
    protected $_wysiwygConfig;
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
        \Custommodule\Design\Model\Designer $designer,
        \Custommodule\Design\Model\PostFactory $postFactory,
        ImageHelper $imageHelper,
        array $data = []
    ) {
        $this->_options = $options;
        $this->_type = $type;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
        $this->imageHelper = $imageHelper;
        $this->_designer = $designer;
        $this->postFactory = $postFactory;
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_post');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form',
                            'enctype' => 'multipart/form-data',
                            'action' => $this->getData('action'),
                            'method' => 'post'
                        ]
            ]
        );

        $form->setHtmlIdPrefix('designs_');
        if ($model->getpageId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Designs'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('page_id', 'hidden', ['name' => 'page_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add New Designs'), 'class' => 'fieldset-wide']
            );
        }
        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);
        $fieldset->addField(
            'page_title',
            'text',
            [
                'name' => 'page_title',
                'label' => __('Page Title'),
                'id' => 'page_title',
                'title' => __('Page Title'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'page_name',
            'text',
            [
                'name' => 'page_name',
                'label' => __('Page Name'),
                'id' => 'page_name',
                'title' => __('Page Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'design_image', 
            Image::class, 
            [
            'name' => 'design_image',
            'label' => __('Designs Image'),
            'title' => __('Designs Image'),
            'path' => $this->imageHelper->getBaseMediaPath(ImageHelper::TEMPLATE_MEDIA_TYPE_DESIGNER)
            ]
        );
        $fieldset->addField(
            'page_des',
            'editor',
            [
                'name' => 'page_des',
                'label' => __('Page Description'),
                'title' => __('Page Description'),
                'style' => 'height:10em',
                'required' => false,
                'config' => $this->_wysiwygConfig->getConfig()
            ]
        );
        $fieldset->addField(
            'page_designer',
            'select',
            [
                'name' => 'page_designer',
                'label' => __('Designer'),
                'id' => 'page_designer',
                'title' => __('Designer'),
                'values' => $this->_designer->getDesignerCollection(),
                'class' => 'designer',
                'required' => true,
            ]
        );

        // $collection = $this->postFactory->create();
        // $itemsArray = [];    
        // foreach($this->postFactory->create()->getCollection()->getItems() as $item) {
        //     $itemsArray[] = $item->getId(); 
        // }
        // $id = $itemsArray;
        // // echo "<pre>";
        // // print_r($id);
        // // die();
        // if ($id > 0) {
        //     $form->getElement('page_designer')->setData('disabled', true);           
        // } 
        if ($model->getpageId()) {
            $form->getElement('page_designer')->setData('disabled', true);           
        }
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
