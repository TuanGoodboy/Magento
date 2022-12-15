<?php
/**
 * Design DesignInterface.
 * @category  Custommodule
 * @package   Custommodule_Design
 * @author    Custommodule
 * @copyright Copyright (c) 2010-2017 Custommodule Software Private Limited (https://Custommodule.com)
 * @license   https://store.Custommodule.com/license.html
 */

namespace Custommodule\Design\Api\Data;

interface DesignsInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const PAGE_ID = 'page_id';
    const PAGE_TITLE = 'page_title';
    const PAGE_NAME = 'page_name';
    const PAGE_DES = 'page_des';
    const PAGE_DESIGNER = 'page_designer';
   /**
    * Get DesignId.
    *
    * @return int
    */
    public function getPageId();

   /**
    * Set DesignId.
    */
    public function setPageId($PageId);

   /**
    * Get PageTitle.
    *
    * @return varchar
    */
    public function getPageTitle();

   /**
    * Set PageTitle.
    */
    public function setPageTitle($PageTitle);

   /**
    * Get PageName.
    *
    * @return varchar
    */
    public function getPageName();

   /**
    * Set PageName.
    */
    public function setPageName($PageName);

   /**
    * Get PageDes.
    *
    * @return varchar
    */
    public function getPageDes();

   /**
    * Set PageDes.
    */
    public function setPageDes($PageDes);

   /**
    * Get CreatedAt.
    *
    * @return varchar
    */
   /**
    * Get PageDesigner.
    *
    * @return varchar
    */
    public function getPageDesigner();

   /**
    * Set PageDesigner.
    */
    public function setPageDesigner($PageDesigner);

   /**
    * Get CreatedAt.
    *
    * @return varchar
    */
    public function getCreatedAt();

   /**
    * Set CreatedAt.
    */
    public function setCreatedAt($createdAt);
       /**
    * Get UpdatedAt.
    *
    * @return varchar
    */
    public function getUpdatedAt();

   /**
    * Set UpdatedAt.
    */
    public function setUpdatedAt($updatedAt);
}
