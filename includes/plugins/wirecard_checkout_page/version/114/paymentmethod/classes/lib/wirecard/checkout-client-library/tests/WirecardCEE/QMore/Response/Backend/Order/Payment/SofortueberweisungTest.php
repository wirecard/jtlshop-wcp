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
 * Test class for WirecardCEE_QMore_Response_Backend_Order_Payment_SofortueberweisungTest.
 * Generated by PHPUnit on 2011-06-24 at 13:26:16.
 */
class WirecardCEE_QMore_Response_Backend_Order_Payment_SofortueberweisungTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var WirecardCEE_QMore_Response_Backend_GetOrderDetails
     */
    protected $object;
    protected $_secret = 'B8AKTPWBRMNBV455FG6M2DANE99WU2';
    protected $_customerId = 'D200001';
    protected $_shopId = 'qmore';
    protected $_language = 'en';
    protected $_toolkitPassword = 'jcv45z';
    protected $_orderNumber = 543132154;


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $customerId = $this->_customerId;
        $shopId     = $this->_shopId;
        $secret     = $this->_secret;
        $language   = $this->_language;

        $oBackClient = new WirecardCEE_QMore_BackendClient(Array(
            'CUSTOMER_ID' => $customerId,
            'SHOP_ID'     => $shopId,
            'SECRET'      => $secret,
            'LANGUAGE'    => $language,
            'PASSWORD'    => $this->_toolkitPassword
        ));

        $this->object = $oBackClient->getOrderDetails($this->_orderNumber)->getOrder()->getPayments()->current();
    }

    public function testGetSenderAccountOwner()
    {
        $this->assertEquals('Test Consumer', $this->object->getSenderAccountOwner());
    }

    public function testGetSenderAccountNumber()
    {
        $this->assertEquals('1234567890', $this->object->getSenderAccountNumber());
    }

    public function testGetSenderBankNumber()
    {
        $this->assertEquals('1234578', $this->object->getSenderBankNumber());
    }

    public function testGetSenderBankName()
    {
        $this->assertEquals('Test Bank', $this->object->getSenderBankName());
    }

    public function testGetSenderBic()
    {
        $this->assertEquals('PNAGDE00000', $this->object->getSenderBic());
    }

    public function testGetSenderIban()
    {
        $this->assertEquals('DE0000000000000000', $this->object->getSenderIban());
    }

    public function testGetSenderCountry()
    {
        $this->assertEquals('DE', $this->object->getSenderCountry());
    }

    public function testGetSecurityCriteria()
    {
        $this->assertEquals('1', $this->object->getSecurityCriteria());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->object = null;
        unset( $this );
    }
}
