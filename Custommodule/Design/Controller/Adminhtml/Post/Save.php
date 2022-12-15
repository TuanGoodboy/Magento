<?php

/**
 * Design Admin Cagegory Map Record Save Controller.
 * @category  Custommodule
 * @package   Custommodule_Design
 * @author    Custommodule
 * @copyright Copyright (c) 2010-2016 Custommodule Software Private Limited (https://Custommodule.com)
 * @license   https://store.Custommodule.com/license.html
 */
namespace Custommodule\Design\Controller\Adminhtml\Post;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem\Directory\WriteInterface;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Custommodule\Design\Model\DesignFactory
     */
    var $PostFactory;
    protected $fileSystem;

    protected $uploaderFactory;

    protected $adapterFactory;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Custommodule\Design\Model\PostFactory $PostFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Custommodule\Design\Model\PostFactory $PostFactory,
        \Magento\Framework\Filesystem $fileSystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory
    ) {
        parent::__construct($context);
        $this->PostFactory = $PostFactory;
        $this->fileSystem = $fileSystem;
        $this->adapterFactory = $adapterFactory;
        $this->uploaderFactory = $uploaderFactory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('design/post/addpost');
            return;
        }
        $base_media_path = 'custommodule/grid/design';
        if (isset($_FILES['design_image']) && isset($_FILES['design_image']['name']) && strlen($_FILES['design_image']['name'])) {

            try {
                $uploader = $this->uploaderFactory->create(
                    ['fileId' => 'design_image']
                );
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->adapterFactory->create();
                $uploader->addValidateCallback('image', $imageAdapter, 'validateUploadFile');
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                $mediaDirectory = $this->fileSystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                $result = $uploader->save(
                    $mediaDirectory->getAbsolutePath($base_media_path)
                );
                $data['design_image'] = $base_media_path.$result['file'];
            } catch (\Exception $e) {
                if ($e->getCode() == 0) {
                    $this->messageManager->addError($e->getMessage());
                }
            }
        } else {
            if (isset($data['design_image']) && isset($data['design_image']['value'])) {
                if (isset($data['design_image']['delete'])) {
                    $data['design_image'] = null;
                    $data['delete_image'] = true;
                } elseif (isset($data['design_image']['value'])) {
                    $data['design_image'] = $data['design_image']['value'];
                } else {
                    $data['design_image'] = null;
                }
            }
        }
        try {
            $rowData = $this->PostFactory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setEntityId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccess(__('Designs has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('design/post/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Custommodule_Design::save');
    }
}
