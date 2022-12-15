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
 * @package     Custommodule_Faqs
 * @copyright   Copyright (c) Custommodule (https://www.Custommodule.com/)
 * @license     https://www.Custommodule.com/LICENSE.txt
 */

namespace Custommodule\Design\Model;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class AuthorStatus
 * @package Custommodule\Faqs\Model\Config\Source
 */
class Type implements ArrayInterface
{

    const ADMIN = '0';
    const CUSTOMER = '1';

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $type = [];
        foreach ($this->toArray() as $value => $label) {
            $type[] = [
                'value' => $value,
                'label' => $label
            ];
        }

        return $type;
    }

    /**
     * Get type in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            self::ADMIN => __('Created by Admin'),
            self::CUSTOMER => __('Customer Register')
        ];
    }
}
