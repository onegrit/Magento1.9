<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2014 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Edit order address form container block
 */
class Mage_Adminhtml_Block_Sales_Order_Address extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        $this->_controller = 'sales_order';
        $this->_mode       = 'address';
        parent::__construct();
        $this->_updateButton('save', 'label', Mage::helper('sales')->__('Save Order Address'));
        $this->_removeButton('delete');
    }

    /**
     * Retrieve text for header element depending on loaded page
     *
     * @return string
     */
    public function getHeaderText()
    {
        $address = Mage::registry('order_address');
        $orderId = $address->getOrder()->getIncrementId();
        if ($address->getAddressType() == 'shipping') {
            $type = Mage::helper('sales')->__('Shipping');
        } else {
            $type = Mage::helper('sales')->__('Billing');
        }
        return Mage::helper('sales')->__('Edit Order %s %s Address', $orderId, $type);
    }

    /**
     * Back button url getter
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl(
            '*/*/view',
            array('order_id'=>Mage::registry('order_address')->getOrder()->getId())
        );
    }
}
