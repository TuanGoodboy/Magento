<?php

/**
 * Grid Grid Collection.
 *
 * @category  Custommodule
 * @package   Custommodule_Design
 * @author    Custommodule
 * @copyright Copyright (c) 2010-2017 Custommodule Software Private Limited (https://Custommodule.com)
 * @license   https://store.Custommodule.com/license.html
 */
namespace Custommodule\Design\Model\ResourceModel\Grid;
use Magento\Framework\DB\Select;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Zend_Db_Select;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'designer_id';
    /**
     * Define resource model.
     */
    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'custom_designer_list';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'custom_designer_list';

    protected function _construct()
    {
        $this->_init(
            'Custommodule\Design\Model\Grid',
            'Custommodule\Design\Model\ResourceModel\Grid'
        );
    }

    /**
     * Get SQL for get record count.
     * Extra GROUP BY strip added.
     *
     * @return Select
     */
    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();
        $countSelect->reset(Zend_Db_Select::GROUP);

        return $countSelect;
    }

    /**
     * @param string $valueField
     * @param string $labelField
     * @param array $additional
     *
     * @return array
     */
    protected function _toOptionArray($valueField = 'designer_id', $labelField = 'name', $additional = [])
    {
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }
    
    public function addIdFilter($designerIds)
    {
        $condition = '';

        if (is_array($designerIds)) {
            if (!empty($designerIds)) {
                $condition = ['in' => $designerIds];
            }
        } elseif (is_numeric($designerIds)) {
            $condition = $designerIds;
        } elseif (is_string($designerIds)) {
            $ids = explode(',', $designerIds);
            if (empty($ids)) {
                $condition = $designerIds;
            } else {
                $condition = ['in' => $ids];
            }
        }

        if ($condition !== '') {
            $this->addFieldToFilter('designer_id', $condition);
        }

        return $this;
    }



}
