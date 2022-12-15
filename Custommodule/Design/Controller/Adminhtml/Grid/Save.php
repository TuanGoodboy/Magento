<?php
namespace Custommodule\Design\Controller\Adminhtml\Grid;
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
    var $GridFactory;
    protected $fileSystem;

    protected $uploaderFactory;

    protected $adapterFactory;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Custommodule\Design\Model\PostFactory $GridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Custommodule\Design\Model\GridFactory $GridFactory,
        \Magento\Framework\Filesystem $fileSystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory
    ) {
        parent::__construct($context);
        $this->GridFactory = $GridFactory;
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
            $this->_redirect('design/post/addrow');
            return;
        }
        $base_media_path = 'custommodule/grid/designer';
        if (isset($_FILES['profile_image']) && isset($_FILES['profile_image']['name']) && strlen($_FILES['profile_image']['name'])) {

            try {
                $uploader = $this->uploaderFactory->create(
                    ['fileId' => 'profile_image']
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
                $data['profile_image'] = $base_media_path.$result['file'];
            } catch (\Exception $e) {
                if ($e->getCode() == 0) {
                    $this->messageManager->addError($e->getMessage());
                }
            }
        } else {
            if (isset($data['profile_image']) && isset($data['profile_image']['value'])) {
                if (isset($data['profile_image']['delete'])) {
                    $data['profile_image'] = null;
                    $data['delete_image'] = true;
                } elseif (isset($data['profile_image']['value'])) {
                    $data['profile_image'] = $data['profile_image']['value'];
                } else {
                    $data['profile_image'] = null;
                }
            }
        }
        try {
            $rowData = $this->GridFactory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setEntityId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccess(__('Designer has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('design/grid/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Custommodule_Design::add_row)');
    }
}
