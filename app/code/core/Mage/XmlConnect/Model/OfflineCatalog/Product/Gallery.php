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
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_XmlConnect
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Xmlconnect offline catalog gallery model
 *
 * @category    Mage
 * @package     Mage_XmlConnect
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_XmlConnect_Model_OfflineCatalog_Product_Gallery extends Mage_XmlConnect_Model_OfflineCatalog_Abstract
{
    /**
     * Gallery url
     */
    const GALLERY_URL = 'xmlconnect/catalog/productgallery/id/%1$s/';

    /**
     * Return gallery block
     *
     * @param Mage_XmlConnect_Helper_OfflineCatalog $exportHelper
     * @return Mage_Core_Block_Abstract
     */
    public function getLayoutBlock($exportHelper)
    {
        return $exportHelper->getBlock('xmlconnect.catalog.product.gallery');
    }

    /**
     * Return gallery url
     *
     * @return string
     */
    protected function _getActionUrl()
    {
        return sprintf(Mage::getBaseUrl() . self::GALLERY_URL, $this->getProduct()->getId());
    }
}
