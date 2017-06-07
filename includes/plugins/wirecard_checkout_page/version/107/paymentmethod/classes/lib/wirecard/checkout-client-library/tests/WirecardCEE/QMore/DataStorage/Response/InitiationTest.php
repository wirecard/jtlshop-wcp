<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Wirecard Central Eastern Europe GmbH
 * (abbreviated to Wirecard CEE) and are explicitly not part of the Wirecard CEE range of
 * products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 2 (GPLv2) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Wirecard CEE does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Wirecard CEE does not guarantee their full
 * functionality neither does Wirecard CEE assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Wirecard CEE does not guarantee the full functionality
 * for customized shop systems or installed plugins of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the plugin's functionality before starting productive
 * operation.
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 */

/**
 * Test class for WirecardCEE_QMore_DataStorage_Response_Initiation.
 * Generated by PHPUnit on 2011-12-30 at 09:22:50.
 */
class WirecardCEE_QMore_DataStorage_Response_InitiationTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var WirecardCEE_QMore_DataStorage_Response_Initiation
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $httpResponse = new \GuzzleHttp\Psr7\Response(200, Array(),
            'pre=bla&storageId=testStorageId&su=blub&javascriptUrl=http://www.example.com');
        $this->object = new WirecardCEE_QMore_DataStorage_Response_Initiation($httpResponse);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    public function testGetStatus()
    {
        $this->assertEquals(WirecardCEE_QMore_DataStorage_Response_Initiation::STATE_SUCCESS,
            $this->object->getStatus());
    }

    public function testGetErrors()
    {
        $this->assertEquals(Array(), $this->object->getErrors());
    }

    public function testGetStorageId()
    {
        $this->assertEquals('testStorageId', $this->object->getStorageId());
    }

    public function testJavascriptUrl()
    {
        $this->assertEquals('http://www.example.com', $this->object->getJavascriptUrl());
    }

    public function testFailureGetStatus()
    {
        $this->_200ErrorResponse();
        $this->assertEquals(WirecardCEE_QMore_DataStorage_Response_Initiation::STATE_FAILURE,
            $this->object->getStatus());
    }

    public function testFailureGetErrors()
    {
        $this->_200ErrorResponse();
        $this->assertInternalType(PHPUnit_Framework_Constraint_IsType::TYPE_ARRAY, $this->object->getErrors());
        foreach ($this->object->getErrors() as $error) {
            $this->assertInstanceOf('WirecardCEE_Stdlib_Error', $error);
        }
        $this->assertEquals($this->object->getNumberOfErrors(), count($this->object->getErrors()));
    }

    protected function _200ErrorResponse()
    {
        $httpResponse = new \GuzzleHttp\Psr7\Response(200, Array(),
            'pre=bla&error.1.errorCode=12345&error.1.message=testMessage&error.2.errorCode=54321&error.2.message=testMessage2&errors=2&su=blub');
        $this->object = new WirecardCEE_QMore_DataStorage_Response_Initiation($httpResponse);
    }
}

?>