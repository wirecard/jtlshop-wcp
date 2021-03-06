<?php
/*
 * Shop System Plugins - Terms of use
 *
 * This terms of use regulates warranty and liability between Wirecard Central Eastern Europe (subsequently referred to as WDCEE) and it's
 * contractual partners (subsequently referred to as customer or customers) which are related to the use of plugins provided by WDCEE.
 *
 * The Plugin is provided by WDCEE free of charge for it's customers and must be used for the purpose of WDCEE's payment platform
 * integration only. It explicitly is not part of the general contract between WDCEE and it's customer. The plugin has successfully been tested
 * under specific circumstances which are defined as the shopsystem's standard configuration (vendor's delivery state). The Customer is
 * responsible for testing the plugin's functionality before putting it into production enviroment.
 * The customer uses the plugin at own risk. WDCEE does not guarantee it's full functionality neither does WDCEE assume liability for any
 * disadvantage related to the use of this plugin. By installing the plugin into the shopsystem the customer agrees to the terms of use.
 * Please do not use this plugin if you do not agree to the terms of use!
 */

if (! class_exists('WirecardCheckoutPage')) {
    require 'WirecardCheckoutPage.php';
}


class WirecardCheckoutPageInstallment extends WirecardCheckoutPage
{
    protected $paymenttype = WirecardCEE_QPay_PaymentType::INSTALLMENT;

    /**
     *
     * @param Kunde $customer
     * @param Warenkorb $cart
     *
     * @return boolean true, if $customer with $cart may use Payment Method
     */
    function isValid($customer, $cart)
    {
        if (! parent::isValid($customer, $cart)) {
            return false;
        }

        $fields = array(
            'cVorname',
            'cNachname',
            'cFirma',
            'cStrasse',
            'cHausnummer',
            'cAdressZusatz',
            'cPLZ',
            'cOrt',
            'cBundesland',
            'cLand'
        );
        foreach ($fields as $f) {
            if ($_SESSION['Lieferadresse']->$f != $customer->$f) {
                return false;
            }
        }

        $currency = $_SESSION['Waehrung'];
        if ($currency->cISO != 'EUR') {
            return false;
        }

        if (! strlen($customer->dGeburtstag) || $customer->dGeburtstag == '00.00.0000') {
            return false;
        }

        try {
            $birthday = new DateTime($customer->dGeburtstag);
        } catch (Exception $e) {
            return false;
        }

        $diff = $birthday->diff(new DateTime);
        $customerAge = $diff->format('%y');
        if ($customerAge < WIRECARD_CHECKOUT_PAGE_INVOICE_INSTALLMENT_MIN_AGE) {
            return false;
        }
        return true;

    }

}