<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Amf
 * @subpackage Value
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: ByteArray.php 24593 2012-01-05 20:35:02Z matthew $
 */

/**
 * Wrapper class to store an AMF3 flash.utils.ByteArray
 *
 * @package    Zend_Amf
 * @subpackage Value
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Amf_Value_ByteArray
{
    /**
     * @var string ByteString Data
     */
    protected $_data = '';

    /**
     * Create a ByteArray
     *
     * @param  string $data
     * @return void
     */
    public function __construct($data)
    {
        $this->_data = $data;
    }

    /**
     * Return the byte stream
     *
     * @return string
     */
    public function getData()
    {
        return $this->_data;
    }
}
