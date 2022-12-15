<?php
namespace MagentoTraining\Helloworld\Block;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Index extends Template
{
    public function getHelloworld($path){
        $this->context->getScopeConfig()->getValue(
            'helloworld/general/display_text',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
