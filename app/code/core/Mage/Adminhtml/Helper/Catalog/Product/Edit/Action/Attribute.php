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
 * @copyright  Copyright (c) 2006-2015 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Adminhtml catalog product action attribute update helper
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Adminhtml_Helper_Catalog_Product_Edit_Action_Attribute extends Mage_Core_Helper_Data
{
    /**
     * Selected products for mass-update
     *
     * @var Mage_Catalog_Model_Entity_Product_Collection
     */
    protected $_products;

    /**
     * Array of same attributes for selected products
     *
     * @var Mage_Eav_Model_Mysql4_Entity_Attribute_Collection
     */
    protected $_attributes;

    /**
     * Excluded from batch update attribute codes
     *
     * @var array
     */
    protected $_excludedAttributes = array('url_key');

    /**
     * Return product collection with selected product filter
     * Product collection didn't load
     *
     * @return Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection
     */
    public function getProducts()
    {
        if (is_null($this->_products)) {
            $productsIds = $this->getProductIds();

            if (!is_array($productsIds)) {
                $productsIds = array(0);
            }

            $this->_products = Mage::getResourceModel('catalog/product_collection')
                ->setStoreId($this->getSelectedStoreId())
                ->addIdFilter($productsIds);
        }

        return $this->_products;
    }

    /**
     * Return array of selected product ids from post or session
     *
     * @return array|null
     */
    public function getProductIds()
    {
        $session = Mage::getSingleton('adminhtml/session');

        if ($this->_getRequest()->isPost() && $this->_getRequest()->getActionName() == 'edit') {
            $session->setProductIds($this->_getRequest()->getParam('product', null));
        }

        return $session->getProductIds();
    }

    /**
     * Return selected store id from request
     *
     * @return integer
     */
    public function getSelectedStoreId()
    {
        return (int)$this->_getRequest()->getParam('store', Mage_Core_Model_App::ADMIN_STORE_ID);
    }

    /**
     * Return array of attribute sets by selected products
     *
     * @return array
     */
    public function getProductsSetIds()
    {
        return $this->getProducts()->getSetIds();
    }

    /**
     * Return collection of same attributes for selected products without unique
     *
     * @return Mage_Eav_Model_Mysql4_Entity_Attribute_Collection
     */
    public function getAttributes()
    {
        if (is_null($this->_attributes)) {
            $this->_attributes  = Mage::getSingleton('eav/config')
                ->getEntityType(Mage_Catalog_Model_Product::ENTITY)
                ->getAttributeCollection()
                ->addIsNotUniqueFilter()
                ->setInAllAttributeSetsFilter($this->getProductsSetIds());

            if ($this->_excludedAttributes) {
                $this->_attributes->addFieldToFilter('attribute_code', array('nin' => $this->_excludedAttributes));
            }

            // check product type apply to limitation and remove attributes that impossible to change in mass-update
            $productTypeIds  = $this->getProducts()->getProductTypeIds();
            foreach ($this->_attributes as $attribute) {
                /* @var $attribute Mage_Catalog_Model_Entity_Attribute */
                foreach ($productTypeIds as $productTypeId) {
                    $applyTo = $attribute->getApplyTo();
                    if (count($applyTo) > 0 && !in_array($productTypeId, $applyTo)) {
                        $this->_attributes->removeItemByKey($attribute->getId());
                        break;
                    }
                }
            }
        }

        return $this->_attributes;
    }

    /**
     * Return product ids that not available for selected store
     *
     * @deprecated since 1.4.1
     * @return array
     */
    public function getProductsNotInStoreIds()
    {
        return array();
    }
}
