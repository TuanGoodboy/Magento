<?php
namespace Custommodule\Design\Model\Config\Source;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem;
use Magento\Framework\UrlInterface;

/**
 * Class Image
 * @package Custommodule\Design\Model\Config\Source
 */
class Image
{
    /**
     * Media sub folder
     *
     * @var string
     */
    public $subDir = 'custommodule/grid/design';

    /**
     * URL builder
     *
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * File system model
     *
     * @var Filesystem
     */
    protected $fileSystem;

    /**
     * constructor
     *
     * @param UrlInterface $urlBuilder
     * @param Filesystem $fileSystem
     */
    public function __construct(UrlInterface $urlBuilder, Filesystem $fileSystem)
    {
        $this->urlBuilder = $urlBuilder;
        $this->fileSystem = $fileSystem;
    }

    /**
     * get images base url
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]);
    }

    /**
     * get base image dir
     *
     * @return string
     * @throws FileSystemException
     */
    public function getBaseDir()
    {
        return $this->fileSystem->getDirectoryWrite(DirectoryList::MEDIA)->getAbsolutePath($this->subDir . '/image/');
    }
}
