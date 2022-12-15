<?php
namespace Custommodule\Design\Model;
use Magento\Framework\Data\Form\Element\CollectionFactory;
use Magento\Framework\Data\Form\Element\Factory;
use Magento\Framework\Data\Form\Element\Multiselect;
use Magento\Framework\Escaper;
use Custommodule\Design\Model\ResourceModel\Grid\Collection;
use Custommodule\Design\Model\ResourceModel\Grid\CollectionFactory as GridCollectionFactory;
class Designer extends Multiselect
{

    /**
     * @var GridCollectionFactory
     */
    public $collectionFactory;

    /**
     * Designer constructor.
     *
     * @param Factory $factoryElement
     * @param CollectionFactory $factoryCollection
     * @param Escaper $escaper
     * @param GridCollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Factory $factoryElement,
        CollectionFactory $factoryCollection,
        Escaper $escaper,
        GridCollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data);
    }

    /**
     * @return mixed
     */
    public function getDesignerCollection()
    {
        /* @var $collection Collection */
        $collection = $this->collectionFactory->create();
        $designerById = [];
        foreach ($collection as $designer) {
            $designerId = $designer->getId();
            $designerById[$designerId]['value'] = $designer->getName();
            $designerById[$designerId]['is_active'] = 1;
            $designerById[$designerId]['label'] = $designer->getName();
        }

        return $designerById;
    }

    private function getNameDesigner($namedesigner)
    {
        $namedesigner = $designerById -> getDesignerCollection()->getName();
        $value = array();
        foreach ($namedesigner as $designer) {
            $value[] = $designer->getName();
        }
        return $value;
    }
    private function getImageDesigner($namedesigner)
    {
        $imagedesigner = $designerById -> getDesignerCollection()->getImage();
        $value = array();
        foreach ($imagedesigner as $designer) {
            $value[] = $designer->getImage();
        }
        return $value;
    }

    /**
     * Get values for select
     *
     * @return array
     */
    public function getValues()
    {
        $values = $this->getValue();
        if (!is_array($values)) {
            $values = explode(',', $values);
        }
        if (empty($values)) {
            return [];
        }
        /* @var $collection Collection */
        $collection = $this->collectionFactory->create()->addIdFilter($values);
        $designer = [];
        foreach ($collection as $_designer) {
            $designer[] = $_designer->getId();
        }
        return $designer;
    }
}
