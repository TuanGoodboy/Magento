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
use Custommodule\Design\Api\Data\DesignerInterface;
class Grid extends \Magento\Framework\Model\AbstractModel implements DesignerInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'custom_designer_list';

    /**
     * @var string
     */
    protected $_cacheTag = 'custom_designer_list';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'custom_designer_list';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Custommodule\Design\Model\ResourceModel\Grid');
    }
    /**
     * Get DesignerId.
     *
     * @return int
     */
    public function getDesignerId()
    {
        return $this->getData(self::DESIGNER_ID);
    }

    /**
     * Set DesignerId.
     */
    public function setDesignerId($DesignerId)
    {
        return $this->setData(self::DESIGNER_ID, $DesignerId);
    }

    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set Title.
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get Name.
     *
     * @return varchar
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set Name.
     */
    public function setName($Name)
    {
        return $this->setData(self::NAME, $Name);
    }
    /**
     * Get Instruction.
     *
     * @return varchar
     */
    public function getInstruction()
    {
        return $this->getData(self::INSTRUCTION);
    }

    /**
     * Set Instruction.
     */
    public function setInstruction($instruction)
    {
        return $this->setData(self::INSTRUCTION, $instruction);
    }

    /**
     * Get Status.
     *
     * @return varchar
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set Status.
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get Image.
     *
     * @return varchar
     */
    public function getImage()
    {
        return $this->getData(self::PROFILE_IMAGE);
    }

    /**
     * Set Image.
     */
    public function setImage($image)
    {
        return $this->setData(self::PROFILE_IMAGE, $image);
    }
        /**
     * Get Type.
     *
     * @return varchar
     */
    public function getType()
    {
        return $this->getData(self::TYPE);
    }

    /**
     * Set Type.
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
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

    public function getUrlImage()
    {
        $imageHelper = $this->helperData->getImageHelper();
        $imageFile   = $this->getImage() ? $imageHelper->getMediaPath($this->getImage(), 'designer') : '';
        $imageUrl    = $imageFile ? $this->helperData->getImageHelper()->getMediaUrl($imageFile) : '';

        $this->setData('profile_image', $imageUrl);

        return $this->_getData('profile_image');
    }
}
