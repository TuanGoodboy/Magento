<?php

/**
 * Post Post Collection.
 *
 * @category  Custommodule
 * @package   Custommodule_Design
 * @author    Custommodule
 * @copyright Copyright (c) 2010-2017 Custommodule Software Private Limited (https://Custommodule.com)
 * @license   https://store.Custommodule.com/license.html
 */
namespace Custommodule\Design\Model\ResourceModel\Post;
use Magento\Framework\DB\Select;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Zend_Db_Select;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'page_id';
    /**
     * Define resource model.
     */
    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'custom_designs_post';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'custom_designs_post';

    protected function _construct()
    {
        $this->_init(
            'Custommodule\Design\Model\Post',
            'Custommodule\Design\Model\ResourceModel\Post'
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
    protected function _toOptionArray($valueField = 'page_id', $labelField = 'name', $additional = [])
    {
        return parent::_toOptionArray($valueField, $labelField, $additional);
    }
    
    public function addIdFilter($pageId)
    {
        $condition = '';

        if (is_array($pageId)) {
            if (!empty($pageId)) {
                $condition = ['in' => $pageId];
            }
        } elseif (is_numeric($pageId)) {
            $condition = $pageId;
        } elseif (is_string($pageId)) {
            $ids = explode(',', $pageId);
            if (empty($ids)) {
                $condition = $pageId;
            } else {
                $condition = ['in' => $ids];
            }
        }

        if ($condition !== '') {
            $this->addFieldToFilter('page_id', $condition);
        }

        return $this;
    }



}
