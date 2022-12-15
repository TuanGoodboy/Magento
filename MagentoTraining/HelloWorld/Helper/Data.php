<?php

namespace MagentoTraining\HelloWorld\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    const XML_PATH_HELLOWORLD = 'helloworld/';

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    public function getGeneralConfig($code, $storeId = null)
    {

        return $this->getConfigValue(self::XML_PATH_HELLOWORLD .'general/'. $code, $storeId);
    }
    
    public function getConfig($path)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);        // From store view
    }

    public function getImageUrl($product)
    {
        $url = false;
        $attribute = $product->getResource()->getAttribute('image');
        if (!$product->getImage()) {
            $url = $this->_assetRepo->getUrl('MagentoTraining::helloworld/image/default/men_top.jpg');
        } elseif ($attribute) {
            $url = $attribute->getFrontend()->getUrl($product);
        }
        return $url;
    }

    /**
     * @var array
     */
    protected $configModule;
    protected $_storeManager;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->configModule = $this->getConfig(strtolower($this->_getModuleName()));
        $this->_storeManager = $storeManager;
    }

    public function getConfigImage($cfg='')
    {
        if($cfg) return $this->scopeConfig->getValue( $cfg, \Magento\Store\Model\ScopeInterface::SCOPE_STORE );
        return $this->scopeConfig;
    }

    public function getConfigModule($cfg='', $value=null)
    {
        $values = $this->configModule;
        if( !$cfg ) return $values;
        $config  = explode('/', $cfg);
        $end     = count($config) - 1;
        foreach ($config as $key => $vl) {
            if( isset($values[$vl]) ){
                if( $key == $end ) {
                    $value = $values[$vl];
                }else {
                    $values = $values[$vl];
                }
            }

        }
        return $value;
    }

    public function getBaseUrlMedia()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

}
