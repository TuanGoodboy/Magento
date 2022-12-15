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

interface DesignerInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const DESIGNER_ID = 'designer_id';
    const TITLE = 'title';
    const NAME = 'name';
    const INSTRUCTION = 'instruction';
    const STATUS = 'status';
    const PROFILE_IMAGE = 'profile_image';
    const TYPE = 'type';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

   /**
    * Get DesignId.
    *
    * @return int
    */
    public function getDesignerId();

   /**
    * Set DesignId.
    */
    public function setDesignerId($DesignerId);

   /**
    * Get Title.
    *
    * @return varchar
    */
    public function getTitle();

   /**
    * Set Title.
    */
    public function setTitle($title);

   /**
    * Get Name.
    *
    * @return varchar
    */
    public function getName();

   /**
    * Set Name.
    */
    public function setName($Name);

   /**
    * Get instruction.
    *
    * @return varchar
    */
    public function getInstruction();

   /**
    * Set instruction.
    */
    public function setinstruction($instruction);

   /**
    * Get Status.
    *
    * @return varchar
    */
    public function getStatus();

   /**
    * Set Status.
    */
    public function setStatus($status);

   /**
    * Get Image.
    *
    * @return varchar
    */
    public function getImage();

   /**
    * Set StartingPrice.
    */
    public function setImage($image);

   /**
    * Get Type.
    *
    * @return varchar
    */
    public function getType();

   /**
    * Set Type.
    */
    public function setType($type);

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
