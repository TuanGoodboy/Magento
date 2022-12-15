<?php
/**
 * Custommodule
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Custommodule.com license that is
 * available through the world-wide-web at this URL:
 * https://www.Custommodule.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Custommodule
 * @package     Custommodule_Design
 * @copyright   Copyright (c) Custommodule (https://www.Custommodule.com/)
 * @license     https://www.Custommodule.com/LICENSE.txt
 */

namespace Custommodule\Design\Helper;

use DateTimeZone;
use Exception;
use Magento\Customer\Model\Context as CustomerContext;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filter\TranslitUrl;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\View\DesignInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use Mageplaza\Core\Helper\AbstractData as CoreHelper;

/**
 * Class Data
 * @package Custommodule\Design\Helper
 */
class Data extends CoreHelper
{
    /**
     * @return Image
     */
    public function getImageHelper()
    {
        return $this->objectManager->get(Image::class);
    }
}
