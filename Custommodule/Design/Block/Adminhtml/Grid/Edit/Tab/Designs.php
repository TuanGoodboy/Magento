<?php
namespace Custommodule\Design\Block\Adminhtml\Grid\Edit\Tab;
use Custommodule\Design\Block\Adminhtml\Renderer\GridImage;
class Designs extends \Magento\Backend\Block\Widget\Grid\Extended
    {
        /**
         * @var \Custommodule\Design\Model\GridFactory
         */
        protected $productFactory;

        public function __construct(
            \Magento\Backend\Block\Template\Context $context,
            \Magento\Backend\Helper\Data $backendHelper,
            \Magento\Framework\Registry $coreRegistry,
            \Custommodule\Design\Model\PostFactory $postFactory,
            array $data = []
        ) {
            $this->postFactory = $postFactory;
            $this->_coreRegistry = $coreRegistry;
            parent::__construct($context, $backendHelper, $data);
        }

        /**
         * @return void
         */
        protected function _construct()
        {
            parent::_construct();
            $this->setId('design_tabs');
            $this->setDefaultSort('page_id');
            $this->setUseAjax(true);
        }

        /**
         * @return Grid
         */
        protected function _prepareCollection()
        {
            $collection = $this->postFactory->create()->getCollection();
            $this->setCollection($collection);
            return parent::_prepareCollection();
        }

        /**
         * @return Extended
         */
        protected function _prepareColumns()
        {
            $this->addColumn('in_designs', [
                'header_css_class' => 'a-center',
                'type' => 'checkbox',
                'name' => 'in_design',
                // 'values' => $this->_getSelectedDesigns(),
                'align' => 'center',
                'index' => 'design_id'
            ]);
            $this->addColumn(
                'page_id',
                [
                    'header' => __('Designs Id'),
                    'sortable' => true,
                    'index' => 'page_id',
                    'header_css_class' => 'col-id',
                    'column_css_class' => 'col-id'
                ]
            );
            $this->addColumn(
                'page_title',
                [
                    'header' => __('Designs Title'),
                    'index' => 'page_name'
                ]
            );
            $this->addColumn(
                'page_name',
                [
                    'header' => __('Designs Name'),
                    'index' => 'page_name'
                ]
                );
            $this->addColumn('design_image', [
                'header' => __('Designs Image'),
                'index' => 'design_image',
                'header_css_class' => 'col-image',
                'column_css_class' => 'col-image',
                'sortable' => false,
                'renderer' => GridImage::class
            ]);

            return parent::_prepareColumns();
    }
        
}