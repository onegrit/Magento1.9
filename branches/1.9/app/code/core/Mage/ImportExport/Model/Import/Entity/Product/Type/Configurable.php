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
 * @package     Mage_ImportExport
 * @copyright  Copyright (c) 2006-2015 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Import entity configurable product type model
 *
 * @category    Mage
 * @package     Mage_ImportExport
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_ImportExport_Model_Import_Entity_Product_Type_Configurable
    extends Mage_ImportExport_Model_Import_Entity_Product_Type_Abstract
{
    /**
     * Error codes.
     */
    const ERROR_ATTRIBUTE_CODE_IS_NOT_SUPER = 'attrCodeIsNotSuper';
    const ERROR_INVALID_PRICE_CORRECTION    = 'invalidPriceCorr';
    const ERROR_INVALID_OPTION_VALUE        = 'invalidOptionValue';
    const ERROR_INVALID_WEBSITE             = 'invalidSuperAttrWebsite';

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $_messageTemplates = array(
        self::ERROR_ATTRIBUTE_CODE_IS_NOT_SUPER => 'Attribute with this code is not super',
        self::ERROR_INVALID_PRICE_CORRECTION    => 'Super attribute price correction value is invalid',
        self::ERROR_INVALID_OPTION_VALUE        => 'Invalid option value',
        self::ERROR_INVALID_WEBSITE             => 'Invalid website code for super attribute'
    );

    /**
     * Column names that holds values with particular meaning.
     *
     * @var array
     */
    protected $_particularAttributes = array(
        '_super_products_sku', '_super_attribute_code', '_super_attribute_option',
        '_super_attribute_price_corr', '_super_attribute_price_website'
    );

    /**
     * Reference array of existing product-attribute to product super attribute ID.
     *
     * product_1 (underscore) attribute_id_1 => product_super_attr_id_1,
     * product_1 (underscore) attribute_id_2 => product_super_attr_id_2,
     * ...,
     * product_n (underscore) attribute_id_n => product_super_attr_id_n
     *
     * @var array
     */
    protected $_productSuperAttrs = array();

    /**
     * Array of SKU to array of super attribute values for all products.
     *
     * array (
     *     attr_set_name_1 => array(
     *         product_id_1 => array(
     *             super_attribute_code_1 => attr_value_1,
     *             ...
     *             super_attribute_code_n => attr_value_n
     *         ),
     *         ...
     *     ),
     *   ...
     * )
     *
     * @var array
     */
    protected $_skuSuperAttributeValues = array();

    /**
     * Array of SKU to array of super attributes data for validation new associated products.
     *
     * array (
     *     product_id_1 => array(
     *         super_attribute_id_1 => array(
     *             value_index_1 => TRUE,
     *             ...
     *             value_index_n => TRUE
     *         ),
     *         ...
     *     ),
     *   ...
     * )
     *
     * @var array
     */
    protected $_skuSuperData = array();

    /**
     * Super attributes codes in a form of code => TRUE array pairs.
     *
     * @var array
     */
    protected $_superAttributes = array();

    /**
     * All super attributes values combinations for each attribute set.
     *
     * @var array
     */
    protected $_superAttrValuesCombs = null;

    /**
     * Add attribute parameters to appropriate attribute set.
     *
     * @param string $attrParams Name of attribute set.
     * @param array $attrParams Refined attribute parameters.
     * @return Mage_ImportExport_Model_Import_Entity_Product_Type_Abstract
     */
    protected function _addAttributeParams($attrSetName, array $attrParams)
    {
        // save super attributes for simplier and quicker search in future
        if ('select' == $attrParams['type'] && 1 == $attrParams['is_global'] && $attrParams['for_configurable']) {
            $this->_superAttributes[$attrParams['code']] = $attrParams;
        }
        return parent::_addAttributeParams($attrSetName, $attrParams);
    }

    /**
     * Get super attribute ID (if it is not possible - return NULL).
     *
     * @param int $productId
     * @param int $attributeId
     * @return array|null
     */
    protected function _getSuperAttributeId($productId, $attributeId)
    {
        if (isset($this->_productSuperAttrs["{$productId}_{$attributeId}"])) {
            return $this->_productSuperAttrs["{$productId}_{$attributeId}"];
        } else {
            return null;
        }
    }

    /**
     * Have we check attribute for is_required? Used as last chance to disable this type of check.
     *
     * @param string $attrCode
     * @return bool
     */
    protected function _isAttributeRequiredCheckNeeded($attrCode)
    {
        return !$this->_isAttributeSuper($attrCode); // do not check super attributes
    }

    /**
     * Is attribute is super-attribute?
     *
     * @param string $attrCode
     * @return boolean
     */
    protected function _isAttributeSuper($attrCode)
    {
        return isset($this->_superAttributes[$attrCode]);
    }

    /**
     * Validate particular attributes columns.
     *
     * @param array $rowData
     * @param int $rowNum
     * @return bool
     */
    protected function _isParticularAttributesValid(array $rowData, $rowNum)
    {
        if (!empty($rowData['_super_attribute_code'])) {
            $superAttrCode = $rowData['_super_attribute_code'];

            if (!$this->_isAttributeSuper($superAttrCode)) { // check attribute superity
                $this->_entityModel->addRowError(self::ERROR_ATTRIBUTE_CODE_IS_NOT_SUPER, $rowNum);
                return false;
            } elseif (isset($rowData['_super_attribute_option']) && strlen($rowData['_super_attribute_option'])) {
                $optionKey = strtolower($rowData['_super_attribute_option']);
                if (!isset($this->_superAttributes[$superAttrCode]['options'][$optionKey])) {
                    $this->_entityModel->addRowError(self::ERROR_INVALID_OPTION_VALUE, $rowNum);
                    return false;
                }
                // check price value
                if (!empty($rowData['_super_attribute_price_corr'])
                    && !$this->_isPriceCorr($rowData['_super_attribute_price_corr'])
                ) {
                    $this->_entityModel->addRowError(self::ERROR_INVALID_PRICE_CORRECTION, $rowNum);
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Array of SKU to array of super attribute values for all products.
     *
     * @return Mage_ImportExport_Model_Import_Entity_Product_Type_Configurable
     */
    protected function _loadSkuSuperAttributeValues()
    {
        if ($this->_superAttributes) {
            $attrSetIdToName   = $this->_entityModel->getAttrSetIdToName();
            $allowProductTypes = array();

            foreach (Mage::getConfig()
                    ->getNode('global/catalog/product/type/configurable/allow_product_types')->children() as $type) {
                $allowProductTypes[] = $type->getName();
            }
            foreach (Mage::getResourceModel('catalog/product_collection')
                        ->addFieldToFilter('type_id', $allowProductTypes)
                        ->addAttributeToSelect(array_keys($this->_superAttributes)) as $product) {
                $attrSetName = $attrSetIdToName[$product->getAttributeSetId()];

                $data = array_intersect_key(
                    $product->getData(),
                    $this->_superAttributes
                );
                foreach ($data as $attrCode => $value) {
                    $attrId = $this->_superAttributes[$attrCode]['id'];
                    $this->_skuSuperAttributeValues[$attrSetName][$product->getId()][$attrId] = $value;
                }
            }
        }
        return $this;
    }

    /**
     * Array of SKU to array of super attribute values for all products.
     *
     * @return Mage_ImportExport_Model_Import_Entity_Product_Type_Configurable
     */
    protected function _loadSkuSuperData()
    {
        if (!$this->_skuSuperData) {
            $connection = $this->_entityModel->getConnection();
            $mainTable  = Mage::getSingleton('core/resource')->getTableName('catalog/product_super_attribute');
            $priceTable = Mage::getSingleton('core/resource')->getTableName('catalog/product_super_attribute_pricing');
            $select     = $connection->select()
                    ->from(array('m' => $mainTable), array('product_id', 'attribute_id', 'product_super_attribute_id'))
                    ->joinLeft(
                        array('p' => $priceTable),
                        $connection->quoteIdentifier('p.product_super_attribute_id') . ' = '
                        . $connection->quoteIdentifier('m.product_super_attribute_id'),
                        array('value_index')
                    );

            foreach ($connection->fetchAll($select) as $row) {
                $attrId = $row['attribute_id'];
                $productId = $row['product_id'];
                if ($row['value_index']) {
                    $this->_skuSuperData[$productId][$attrId][$row['value_index']] = true;
                }
                $this->_productSuperAttrs["{$productId}_{$attrId}"] = $row['product_super_attribute_id'];
            }
        }
        return $this;
    }

    /**
     * Validate and prepare data about super attributes and associated products.
     *
     * @param array $superData
     * @param array $superAttributes
     * @return Mage_ImportExport_Model_Import_Entity_Product_Type_Configurable
     */
    protected function _processSuperData(array $superData, array &$superAttributes)
    {
        if ($superData) {
            $usedCombs = array();
            // is associated products applicable?
            foreach (array_keys($superData['assoc_ids']) as $assocId) {
                if (!isset($this->_skuSuperAttributeValues[$superData['attr_set_code']][$assocId])) {
                    continue;
                }
                if ($superData['used_attributes']) {
                    $skuSuperValues = $this->_skuSuperAttributeValues[$superData['attr_set_code']][$assocId];
                    $usedCombParts  = array();

                    foreach ($superData['used_attributes'] as $usedAttrId => $usedValues) {
                        if (empty($skuSuperValues[$usedAttrId]) || !isset($usedValues[$skuSuperValues[$usedAttrId]])) {
                            continue; // invalid value or value does not exists for associated product
                        }
                        $usedCombParts[] = $skuSuperValues[$usedAttrId];
                        $superData['used_attributes'][$usedAttrId][$skuSuperValues[$usedAttrId]] = true;
                    }
                    $comb = implode('|', $usedCombParts);

                    if (isset($usedCombs[$comb])) {
                        continue; // super attributes values combination was already used
                    }
                    $usedCombs[$comb] = true;
                }
                $superAttributes['super_link'][] = array(
                    'product_id' => $assocId, 'parent_id' => $superData['product_id']
                );
                $superAttributes['relation'][] = array(
                    'parent_id' => $superData['product_id'], 'child_id' => $assocId
                );
            }
            // clean up unused values pricing
            foreach ($superData['used_attributes'] as $usedAttrId => $usedValues) {
                foreach ($usedValues as $optionId => $isUsed) {
                    if (!$isUsed
                        && isset($superAttributes['pricing'][$superData['product_id']][$usedAttrId])
                    ) {
                        foreach ($superAttributes['pricing'][$superData['product_id']][$usedAttrId] as $k => $params) {
                            if ($optionId == $params['value_index']) {
                                unset($superAttributes['pricing'][$superData['product_id']][$usedAttrId][$k]);
                            }
                        }
                    }
                }
            }
        }
        return $this;
    }

    /**
     * Save product type specific data.
     *
     * @throws Exception
     * @return Mage_ImportExport_Model_Import_Entity_Product_Type_Abstract
     */
    public function saveData()
    {
        $connection      = $this->_entityModel->getConnection();
        $mainTable       = Mage::getSingleton('core/resource')->getTableName('catalog/product_super_attribute');
        $labelTable      = Mage::getSingleton('core/resource')->getTableName('catalog/product_super_attribute_label');
        $priceTable      = Mage::getSingleton('core/resource')->getTableName('catalog/product_super_attribute_pricing');
        $linkTable       = Mage::getSingleton('core/resource')->getTableName('catalog/product_super_link');
        $relationTable   = Mage::getSingleton('core/resource')->getTableName('catalog/product_relation');
        $newSku          = $this->_entityModel->getNewSku();
        $oldSku          = $this->_entityModel->getOldSku();
        $productSuperData = array();
        $productData     = null;
        $nextAttrId      = Mage::getResourceHelper('importexport')->getNextAutoincrement($mainTable);

        if ($this->_entityModel->getBehavior() == Mage_ImportExport_Model_Import::BEHAVIOR_APPEND) {
            $this->_loadSkuSuperData();
        }
        $this->_loadSkuSuperAttributeValues();

        while ($bunch = $this->_entityModel->getNextBunch()) {
            $superAttributes = array(
                'attributes' => array(),
                'labels'     => array(),
                'pricing'    => array(),
                'super_link' => array(),
                'relation'   => array()
            );
            foreach ($bunch as $rowNum => $rowData) {
                if (!$this->_entityModel->isRowAllowedToImport($rowData, $rowNum)) {
                    continue;
                }
                // remember SCOPE_DEFAULT row data
                $scope = $this->_entityModel->getRowScope($rowData);
                if (Mage_ImportExport_Model_Import_Entity_Product::SCOPE_DEFAULT == $scope) {
                    $productData = $newSku[$rowData[Mage_ImportExport_Model_Import_Entity_Product::COL_SKU]];

                    if ($this->_type != $productData['type_id']) {
                        $productData = null;
                        continue;
                    }
                    $productId = $productData['entity_id'];

                    $this->_processSuperData($productSuperData, $superAttributes);

                    $productSuperData = array(
                        'product_id'      => $productId,
                        'attr_set_code'   => $productData['attr_set_code'],
                        'used_attributes' => empty($this->_skuSuperData[$productId])
                                             ? array() : $this->_skuSuperData[$productId],
                        'assoc_ids'       => array()
                    );
                } elseif (null === $productData) {
                    continue;
                }
                if (!empty($rowData['_super_products_sku'])) {
                    if (isset($newSku[$rowData['_super_products_sku']])) {
                        $productSuperData['assoc_ids'][$newSku[$rowData['_super_products_sku']]['entity_id']] = true;
                    } elseif (isset($oldSku[$rowData['_super_products_sku']])) {
                        $productSuperData['assoc_ids'][$oldSku[$rowData['_super_products_sku']]['entity_id']] = true;
                    }
                }
                if (empty($rowData['_super_attribute_code'])) {
                    continue;
                }
                $attrParams = $this->_superAttributes[$rowData['_super_attribute_code']];

                if ($this->_getSuperAttributeId($productId, $attrParams['id'])) {
                    $productSuperAttrId = $this->_getSuperAttributeId($productId, $attrParams['id']);
                } elseif (!isset($superAttributes['attributes'][$productId][$attrParams['id']])) {
                    $productSuperAttrId = $nextAttrId++;
                    $superAttributes['attributes'][$productId][$attrParams['id']] = array(
                        'product_super_attribute_id' => $productSuperAttrId, 'position' => 0
                    );
                    $superAttributes['labels'][] = array(
                        'product_super_attribute_id' => $productSuperAttrId,
                        'store_id'    => 0,
                        'use_default' => 1,
                        'value'       => $attrParams['frontend_label']
                    );
                }
                if (isset($rowData['_super_attribute_option']) && strlen($rowData['_super_attribute_option'])) {
                    $optionId = $attrParams['options'][strtolower($rowData['_super_attribute_option'])];

                    if (!isset($productSuperData['used_attributes'][$attrParams['id']][$optionId])) {
                        $productSuperData['used_attributes'][$attrParams['id']][$optionId] = false;
                    }
                    if (!empty($rowData['_super_attribute_price_corr'])) {
                        $superAttributes['pricing'][] = array(
                            'product_super_attribute_id' => $productSuperAttrId,
                            'value_index'   => $optionId,
                            'is_percent'    => '%' == substr($rowData['_super_attribute_price_corr'], -1),
                            'pricing_value' => (float) rtrim($rowData['_super_attribute_price_corr'], '%'),
                            'website_id'    => 0
                        );
                    }
                }
            }
            // save last product super data
            $this->_processSuperData($productSuperData, $superAttributes);

            // remove old data if needed
            if ($this->_entityModel->getBehavior() != Mage_ImportExport_Model_Import::BEHAVIOR_APPEND
                && $superAttributes['attributes']) {
                $quoted = $connection->quoteInto('IN (?)', array_keys($superAttributes['attributes']));
                $connection->delete($mainTable, "product_id {$quoted}");
                $connection->delete($linkTable, "parent_id {$quoted}");
                $connection->delete($relationTable, "parent_id {$quoted}");
            }
            $mainData = array();

            foreach ($superAttributes['attributes'] as $productId => $attributesData) {
                foreach ($attributesData as $attrId => $row) {
                    $row['product_id']   = $productId;
                    $row['attribute_id'] = $attrId;
                    $mainData[]          = $row;
                }
            }
            if ($mainData) {
                $connection->insertOnDuplicate($mainTable, $mainData);
            }
            if ($superAttributes['labels']) {
                $connection->insertOnDuplicate($labelTable, $superAttributes['labels']);
            }
            if ($superAttributes['pricing']) {
                $connection->insertOnDuplicate(
                    $priceTable,
                    $superAttributes['pricing'],
                    array('is_percent', 'pricing_value')
                );
            }
            if ($superAttributes['super_link']) {
                $connection->insertOnDuplicate($linkTable, $superAttributes['super_link']);
            }
            if ($superAttributes['relation']) {
                $connection->insertOnDuplicate($relationTable, $superAttributes['relation']);
            }
        }
        return $this;
    }
}
