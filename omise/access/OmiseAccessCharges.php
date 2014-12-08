<?php
require_once dirname(__FILE__).'/OmiseAccessBase.php';
require_once dirname(__FILE__).'/../model/OmiseAccount.php';

class OmiseAccessCharges extends OmiseAccessBase {
	const PARAM_CUSTOMER = 'customer';
	const PARAM_CARD = 'card';
	const PARAM_RETURN_URI = 'return_uri';
	const PARAM_AMOUNT = 'amount';
	const PARAM_CURRENCY = 'currency';
	const PARAM_CAPTURE = 'capture';
	const PARAM_DESCRIPTION = 'description';
	const PARAM_IP = 'ip';
	
	/**
	 * チャージの一覧を取得する
	 * @return OmiseList
	 */
	public function listAll() {
		$array = parent::execute(parent::URLBASE_API.'/charges', parent::REQUEST_GET, $this->_secretkey);
		
		return new OmiseList($array);
	}
	
	/**
	 * 
	 * @param OmiseChargeCreateInfo $chargeCreateInfo
	 * @return OmiseCharge
	 */
	public function create($chargeCreateInfo) {
		$param = array(
			self::PARAM_RETURN_URI => $chargeCreateInfo->getReturnUri(),
			self::PARAM_AMOUNT => $chargeCreateInfo->getAmount()
		);
		if($chargeCreateInfo->getCustomer() !== null) $param += array(self::PARAM_CUSTOMER => $chargeCreateInfo->getCustomer());
		if($chargeCreateInfo->getCard() !== null) $param += array(self::PARAM_CARD => $chargeCreateInfo->getCard());
		if($chargeCreateInfo->getCurrency() !== null) $param += array(self::PARAM_CURRENCY => $chargeCreateInfo->getCurrency());
		if($chargeCreateInfo->getCapture() !== null) $param += array(self::PARAM_CAPTURE => $chargeCreateInfo->getCapture());
		if($chargeCreateInfo->getDescription() !== null) $param += array(self::PARAM_DESCRIPTION => $chargeCreateInfo->getDescription());
		if($chargeCreateInfo->getIP() !== null) $param += array(self::PARAM_IP => $chargeCreateInfo->getIP());
		
		$array = parent::execute(parent::URLBASE_API.'/charges', parent::REQUEST_POST, $this->_secretkey, $param);
		
		return new OmiseCharge($array);
	}
}