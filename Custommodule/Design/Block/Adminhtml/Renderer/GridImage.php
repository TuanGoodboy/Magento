<?php
namespace Custommodule\Design\Block\Adminhtml\Renderer;
use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Custommodule\Design\Model\Config\Source\Image as ImageModel;

/**
 * Class GridImage
 * @package Custommodule\Design\Block\Adminhtml\Renderer
 */
class GridImage extends AbstractRenderer
{
    /**
     * @var ImageModel
     */
    protected $imageModel;

    /**
     * GridImage constructor.
     *
     * @param Context $context
     * @param ImageModel $imageModel
     * @param array $data
     */
    public function __construct(
        Context $context,
        ImageModel $imageModel,
        array $data = []
    ) {
        $this->imageModel = $imageModel;

        parent::__construct($context, $data);
    }

    /**
     * Render Banner Image
     *
     * @param DataObject $row
     *
     * @return string
     */
    public function render(DataObject $row)
    {
        if ($row->getData($this->getColumn()->getIndex())) {
            $imageUrl = $this->imageModel->getBaseUrl() . $row->getData($this->getColumn()->getIndex());

            return '<img src="' . $imageUrl . '" width=\'120\' class="admin__control-thumbnail"/>';
        }

        return '';
    }
}
