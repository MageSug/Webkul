<?php

namespace Webkul\BlogManager\Helper;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Helper\Context;

class CustomerIdData extends \Magento\Framework\App\Helper\AbstractHelper
{
    public $customerSession;

    public function __construct(Context $context, Session $session)
    {
        $this->customerSession = $session;
        parent::__construct($context);
    }

    public function getCustomerId()
    {
        return $this->customerSession->getCustomerId();
    }
}
