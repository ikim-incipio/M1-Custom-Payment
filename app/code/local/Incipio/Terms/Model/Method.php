<?php
class Incipio_Terms_Model_Method extends Mage_Payment_Model_Method_Abstract
{
	protected $_canAuthorize = true;

	protected $_code = 'terms';

	public function isAvailable ($quote = null)
	{
		$groupId = Mage::getSingleton('customer/session', array('name' => 'frontend'))->isLoggedIn() ? Mage::getSingleton('customer/session')->getCustomerGroupId() : 0;
		return parent::isAvailable($quote) && !empty($quote) && $this->getConfigData('default_group') == $groupId;
	}

	public function getConfigPaymentAction()
    {
        return $this->getConfigData('order_status') == 'pending' ? null : parent::getConfigPaymentAction();
    }
}