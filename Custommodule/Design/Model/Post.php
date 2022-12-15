<?php

/**
 * Design Design Model.
 * @category  Custom
 * @package   Custom_Design
 * @author    Custom
 * @copyright Copyright (c) 2010-2017 Custom Software Private Limited (https://Custom.com)
 * @license   https://store.Custom.com/license.html
 */
namespace Custommodule\Design\Model;
use Custommodule\Design\Api\Data\DesignsInterface;
class Post extends \Magento\Framework\Model\AbstractModel implements DesignsInterface
{
    /**
     * CMS Page cache tag.
     */
    const CACHE_TAG = 'custom_designs_post';

    /**
     * @var string
     */
    protected $_cacheTag = 'custom_designs_post';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'custom_designs_post';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Custommodule\Design\Model\ResourceModel\Post');
    }
    /**
     * Get PageId.
     *
     * @return int
     */
    public function getPageId()
    {
        return $this->getData(self::PAGE_ID);
    }

    /**
     * Set PageId.
     */
    public function setPageId($PageId)
    {
        return $this->setData(self::PAGE_ID, $PageId);
    }

    /**
     * Get getPageTitle.
     *
     * @return varchar
     */
    public function getPageTitle()
    {
        return $this->getData(self::PAGE_TITLE);
    }

    /**
     * Set PageTitle.
     */
    public function setPageTitle($PageTitle)
    {
        return $this->setData(self::PAGE_TITLE, $PageTitle);
    }

    /**
     * Get PageName.
     *
     * @return varchar
     */
    public function getPageName()
    {
        return $this->getData(self::PAGE_NAME);
    }

    /**
     * Set PageName.
     */
    public function setPageName($PageName)
    {
        return $this->setData(self::PAGE_NAME, $PageName);
    }

    /**
     * Get PageDes.
     *
     * @return varchar
     */
    public function getPageDes()
    {
        return $this->getData(self::PAGE_DES);
    }

    /**
     * Set PageDes.
     */
    public function setPageDes($PageDes)
    {
        return $this->setData(self::PAGE_DES, $PageDes);
    }

    /**
     * Get PageDesigner.
     *
     * @return varchar
     */
    public function getPageDesigner()
    {
        return $this->getData(self::PAGE_DES);
    }

    /**
     * Set PageDesigner.
     */
    public function setPageDesigner($PageDesigner)
    {
        return $this->setData(self::PAGE_DESIGNER, $PageDesigner);
    }
    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set CreatedAt.
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
        /**
     * Get Updated.
     *
     * @return varchar
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set Updated.
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

}
