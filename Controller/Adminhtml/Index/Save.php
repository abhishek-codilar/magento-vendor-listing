<?php

namespace Codilar\Vendor\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Action;
use Codilar\Vendor\Model\VendorFactory as ModelFactory;
use Codilar\Vendor\Model\ResourceModel\Vendor as ResourceModel;
use Magento\Framework\App\Action\Context;

class Save extends Action
{
    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;

    public function __construct(
        Context $context,
        ModelFactory $modelFactory,
        ResourceModel $resourceModel
    )
    {
        parent::__construct($context);
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
    }

    public function execute()
    {
        $emptyVendor = $this->modelFactory->create();
        $data = $this->getRequest()->getParams();
        if(!empty($data['entity_id'])){
        $this->resourceModel->load($emptyVendor,$data['entity_id']);
        }
        $emptyVendor->setIsActive($data['is_active'] ?? 1);
        $emptyVendor->setVendorName($data['vendor_name'] ?? null);
        $emptyVendor->setWebsite($data['website'] ?? null);
        $emptyVendor->setEmail($data['email'] ?? null);
        $emptyVendor->setDescription($data['description'] ?? null);

        $this->resourceModel->save($emptyVendor);
        $this->messageManager->addSuccessMessage(__('Vendor %1 saved successfully', $emptyVendor->getVendorName()));
        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }
}
