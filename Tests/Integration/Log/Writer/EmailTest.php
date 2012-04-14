<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Steffen Mueller <typo3@t3node.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 */
class Tx_LogWriteremail_Log_Writer_EmailTest extends tx_phpunit_testcase {


	/** @var Tx_LogWriteremail_Log_Writer_Email */
	private $fixture = NULL;


	public function setUp() {
		$this->fixture = new Tx_LogWriteremail_Log_Writer_Email();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function constructorSetsSenderToGlobalEmailAddress() {
		$expectedAddress = 'sender@foo.bar';
		$GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress'] = $expectedAddress;
		$this->fixture = new Tx_LogWriteremail_Log_Writer_Email();
		$this->assertSame(
			$expectedAddress,
			$this->fixture->getSender()
		);
	}

	/**
	 * @test
	 */
	public function constructorSetsRecipientToGlobalEmailAddress() {
		$expectedAddress = 'recipient@foo.bar';
		$GLOBALS['TYPO3_CONF_VARS']['BE']['warning_email_addr'] = $expectedAddress;
		$this->fixture = new Tx_LogWriteremail_Log_Writer_Email();
		$this->assertSame(
			$expectedAddress,
			$this->fixture->getRecipient()
		);
	}

	/**
	 * @test
	 */
	public function writeLogOnEmptySenderReturnsFalse() {
		$logRecord = $this->getMockT3libLogRecord();
		$logRecord->expects($this->any())->method('getLevel')->will($this->returnValue(5));
		$this->fixture->setSender('');
		$this->assertSame(
			FALSE,
			$this->fixture->writeLog($logRecord)
		);
	}

	/**
	 * @test
	 */
	public function writeLogOnEmptyRecipientReturnsFalse() {
		$logRecord = $this->getMockT3libLogRecord();
		$logRecord->expects($this->any())->method('getLevel')->will($this->returnValue(5));
		$this->fixture->setRecipient('');
		$this->assertSame(
			FALSE,
			$this->fixture->writeLog($logRecord)
		);

	}

	/**
	 * @return t3lib_log_Record|PHPUnit_Framework_MockObject_MockObject
	 */
	private function getMockT3libLogRecord() {
		$logRecord = $this->getMock('t3lib_log_Record', array(), array('', 5, ''));
		return $logRecord;
	}

}

?>