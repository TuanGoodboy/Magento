<?php
namespace Custommodule\Design\Block\Adminhtml\Renderer;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\CollectionFactory;
use Magento\Framework\Data\Form\Element\Factory;
use Magento\Framework\Escaper;
use Magento\Framework\UrlInterface;
use Custommodule\Design\Model\Config\Source\Image as ImageModel;

/**
 * Class Image
 * @package Custommodule\Design\Block\Adminhtml\Banner\Edit\Tab\Render
 */
class Image extends \Magento\Framework\Data\Form\Element\Image
{
    /**
     * @var ImageModel
     */
    protected $imageModel;

    /**
     * Image constructor.
     *
     * @param ImageModel $imageModel
     * @param Factory $factoryElement
     * @param CollectionFactory $factoryCollection
     * @param Escaper $escaper
     * @param UrlInterface $urlBuilder
     * @param array $data
     */
    public function __construct(
        ImageModel $imageModel,
        Factory $factoryElement,
        CollectionFactory $factoryCollection,
        Escaper $escaper,
        UrlInterface $urlBuilder,
        array $data
    ) {
        $this->imageModel = $imageModel;

        parent::__construct($factoryElement, $factoryCollection, $escaper, $urlBuilder, $data);
    }

    /**
     * Get image preview url
     *
     * @return string
     */
    protected function _getUrl()
    {
        $url = '';
        if ($this->getValue()) {
            $url = $this->imageModel->getBaseUrl() . $this->getValue();
        }

        return $url;
    }

    /**
     * Return element html code
     *
     * @return string
     */
    public function getElementHtml()
    {
        $html = '';

        if ((string)$this->getValue()) {
            $url = $this->_getUrl();

            if (!preg_match("/^http\:\/\/|https\:\/\//", $url)) {
                $url = $this->_urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]) . $url;
            }

            $html = '<a href="' .
                $url .
                '"' .
                ' onclick="imagePreview(\'' .
                $this->getHtmlId() .
                '_image\'); return false;" ' .
                $this->_getUiId(
                    'link'
                ) .
                '>' .
                '<img src="' .
                $url .
                '" id="' .
                $this->getHtmlId() .
                '_image" title="' .
                $this->getValue() .
                '"' .
                ' alt="' .
                $this->getValue() .
                '" height="156" width="150px" class="small-image-preview v-middle"  ' .
                $this->_getUiId() .
                ' />' .
                '</a> ';
        }
        $this->setClass('input-file');
        $html .= AbstractElement::getElementHtml();
        $html .= $this->_getDeleteCheckbox();

        return $html;
    }
}
