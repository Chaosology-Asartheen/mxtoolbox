<?php
namespace MXTests;

use MxToolbox\MxToolbox;
use MxToolbox\Exception\MxToolboxException;

class checkDNSBLTest extends MxToolboxCaseTest {

	public function testDNSBLBadConstructor() {
		try {
			$mxt = new MxToolbox('/usr/DIG');
		}
		catch (MxToolboxException $e) {
			$this->assertContains('File does not exist!', $e->getMessage());
		}
	}

	public function testDNSBL() {
		$mxt = new MxToolbox('/usr/bin/dig');
		$mxt->pushDNSResolverIP('8.8.8.8');
		$mxt->loadBlacklist();
		$this->assertTrue( $mxt->checkAllrBLS('127.0.0.2') );
		$this->assertInternalType( 'array', $mxt->getBlackLists() );
		$this->assertInternalType( 'array', $mxt->getCheckResult() );
	}
	
}
