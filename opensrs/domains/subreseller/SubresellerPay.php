<?php

namespace opensrs\domains\subreseller;

use OpenSRS\Base;
use OpenSRS\Exception;

class SubresellerPay extends Base {
	public $action = "pay";
	public $object = "subreseller";

	public $_formatHolder = "";
	public $resultFullRaw;
	public $resultRaw;
	public $resultFullFormatted;
	public $resultFormatted;

	public function __construct( $formatString, $dataObject, $returnFullResponse = true ) {
		parent::__construct();

		$this->_formatHolder = $formatString;

		$this->_validateObject( $dataObject );

		$this->send( $dataObject, $returnFullResponse );
	}

	public function __destruct() {
		parent::__destruct();
	}

	// Validate the object
	public function _validateObject( $dataObject ) {
		if(
			!isset( $dataObject->attributes->amount ) ||
			$dataObject->attributes->amount == ""
		) {
			throw new Exception( "oSRS Error - amount is not defined." );
		}
		if(
			!isset( $dataObject->attributes->username ) ||
			$dataObject->attributes->username == ""
		) {
			throw new Exception( "oSRS Error - username is not defined." );
		}
	}
}