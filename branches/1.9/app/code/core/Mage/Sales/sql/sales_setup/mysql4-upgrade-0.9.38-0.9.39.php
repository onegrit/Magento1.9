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
 * @package     Mage_Sales
 * @copyright  Copyright (c) 2006-2014 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/* @var $installer Mage_Sales_Model_Mysql4_Setup */
$installer = $this;

$installer->startSetup();
$installer->getConnection()->addColumn($installer->getTable('sales_flat_quote_item'),
    'store_id', 'smallint(5) unsigned default null AFTER `product_id`');
$installer->getConnection()->addConstraint('FK_SALES_QUOTE_ITEM_STORE',
    $installer->getTable('sales_flat_quote_item'), 'store_id',
    $installer->getTable('core/store'), 'store_id',
    'set null', 'cascade'
);
$installer->getConnection()->addColumn($installer->getTable('sales_flat_order_item'),
    'store_id', 'smallint(5) unsigned default null AFTER `quote_item_id`');
$installer->getConnection()->addConstraint('FK_SALES_ORDER_ITEM_STORE',
    $installer->getTable('sales_flat_order_item'), 'store_id',
    $installer->getTable('core/store'), 'store_id',
    'set null', 'cascade'
);
$installer->addAttribute('quote_item', 'redirect_url', array(
    'type'  => 'varchar',
));
$installer->endSetup();
