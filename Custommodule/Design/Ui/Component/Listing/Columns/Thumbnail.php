<?php
namespace Custommodule\Design\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column {

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource) {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as &$item) {
                if ($item['profile_image']) {
                    $imageUrl = $this->urlBuilder->getBaseUrl().'/media/'. $item['profile_image'];
                    $item[$fieldName . '_src'] = $imageUrl;
                    $item[$fieldName . '_alt'] = $item['profile_image'];
                    $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
                        'custommodule/index/form',
                        ['designer_id' => $item['designer_id']]);
                    $item[$fieldName . '_orig_src'] = $imageUrl;
                }
            }
        }
        return $dataSource;
    }
}