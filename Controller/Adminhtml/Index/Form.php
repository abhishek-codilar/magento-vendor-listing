<?php

namespace Codilar\Vendor\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Form extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    )
    {
        
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set('');
        return $page;
    }
}
