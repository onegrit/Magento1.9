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
 * @package    Zend_Pdf
 * @subpackage Fonts
 * @copyright  Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */


/** Internally used classes */
#require_once 'Zend/Pdf/Element/Name.php';


/** Zend_Pdf_Resource_Font_Simple_Standard */
#require_once 'Zend/Pdf/Resource/Font/Simple/Standard.php';

/**
 * Implementation for the standard PDF font Courier.
 *
 * This class was generated automatically using the font information and metric
 * data contained in the Adobe Font Metric (AFM) files, available here:
 * {@link http://partners.adobe.com/public/developer/en/pdf/Core14_AFMs.zip}
 *
 * The PHP script used to generate this class can be found in the /tools
 * directory of the framework distribution. If you need to make modifications to
 * this class, chances are the same modifications are needed for the rest of the
 * standard fonts. You should modify the script and regenerate the classes
 * instead of changing this class file by hand.
 *
 * @package    Zend_Pdf
 * @subpackage Fonts
 * @copyright  Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Pdf_Resource_Font_Simple_Standard_Courier extends Zend_Pdf_Resource_Font_Simple_Standard
{
  /**** Public Interface ****/


  /* Object Lifecycle */

    /**
     * Object constructor
     */
    public function __construct()
    {
        parent::__construct();


        /* Object properties */

        /* The font names are stored internally as Unicode UTF-16BE-encoded
         * strings. Since this information is static, save unnecessary trips
         * through iconv() and just use pre-encoded hexidecimal strings.
         */
        $this->_fontNames[Zend_Pdf_Font::NAME_COPYRIGHT]['en'] =
          "\x00\x43\x00\x6f\x00\x70\x00\x79\x00\x72\x00\x69\x00\x67\x00\x68\x00"
          . "\x74\x00\x20\x00\x28\x00\x63\x00\x29\x00\x20\x00\x31\x00\x39\x00"
          . "\x38\x00\x39\x00\x2c\x00\x20\x00\x31\x00\x39\x00\x39\x00\x30\x00"
          . "\x2c\x00\x20\x00\x31\x00\x39\x00\x39\x00\x31\x00\x2c\x00\x20\x00"
          . "\x31\x00\x39\x00\x39\x00\x32\x00\x2c\x00\x20\x00\x31\x00\x39\x00"
          . "\x39\x00\x33\x00\x2c\x00\x20\x00\x31\x00\x39\x00\x39\x00\x37\x00"
          . "\x20\x00\x41\x00\x64\x00\x6f\x00\x62\x00\x65\x00\x20\x00\x53\x00"
          . "\x79\x00\x73\x00\x74\x00\x65\x00\x6d\x00\x73\x00\x20\x00\x49\x00"
          . "\x6e\x00\x63\x00\x6f\x00\x72\x00\x70\x00\x6f\x00\x72\x00\x61\x00"
          . "\x74\x00\x65\x00\x64\x00\x2e\x00\x20\x00\x20\x00\x41\x00\x6c\x00"
          . "\x6c\x00\x20\x00\x52\x00\x69\x00\x67\x00\x68\x00\x74\x00\x73\x00"
          . "\x20\x00\x52\x00\x65\x00\x73\x00\x65\x00\x72\x00\x76\x00\x65\x00"
          . "\x64\x00\x2e";
        $this->_fontNames[Zend_Pdf_Font::NAME_FAMILY]['en'] =
          "\x00\x43\x00\x6f\x00\x75\x00\x72\x00\x69\x00\x65\x00\x72";
        $this->_fontNames[Zend_Pdf_Font::NAME_STYLE]['en'] =
          "\x00\x4d\x00\x65\x00\x64\x00\x69\x00\x75\x00\x6d";
        $this->_fontNames[Zend_Pdf_Font::NAME_ID]['en'] =
          "\x00\x34\x00\x33\x00\x30\x00\x35\x00\x30";
        $this->_fontNames[Zend_Pdf_Font::NAME_FULL]['en'] =
          "\x00\x43\x00\x6f\x00\x75\x00\x72\x00\x69\x00\x65\x00\x72\x00\x20\x00"
          . "\x4d\x00\x65\x00\x64\x00\x69\x00\x75\x00\x6d";
        $this->_fontNames[Zend_Pdf_Font::NAME_VERSION]['en'] =
          "\x00\x30\x00\x30\x00\x33\x00\x2e\x00\x30\x00\x30\x00\x30";
        $this->_fontNames[Zend_Pdf_Font::NAME_POSTSCRIPT]['en'] =
          "\x00\x43\x00\x6f\x00\x75\x00\x72\x00\x69\x00\x65\x00\x72";

        $this->_isBold = false;
        $this->_isItalic = false;
        $this->_isMonospaced = true;

        $this->_underlinePosition = -100;
        $this->_underlineThickness = 50;
        $this->_strikePosition = 225;
        $this->_strikeThickness = 50;

        $this->_unitsPerEm = 1000;

        $this->_ascent  = 629;
        $this->_descent = -157;
        $this->_lineGap = 414;

        /* The glyph numbers assigned here are synthetic; they do not match the
         * actual glyph numbers used by the font. This is not a big deal though
         * since this data never makes it to the PDF file. It is only used
         * internally for layout calculations.
         */
        $this->_glyphWidths = array(
            0x00 => 0x01f4,   0x01 => 0x0258,   0x02 => 0x0258,   0x03 => 0x0258,
            0x04 => 0x0258,   0x05 => 0x0258,   0x06 => 0x0258,   0x07 => 0x0258,
            0x08 => 0x0258,   0x09 => 0x0258,   0x0a => 0x0258,   0x0b => 0x0258,
            0x0c => 0x0258,   0x0d => 0x0258,   0x0e => 0x0258,   0x0f => 0x0258,
            0x10 => 0x0258,   0x11 => 0x0258,   0x12 => 0x0258,   0x13 => 0x0258,
            0x14 => 0x0258,   0x15 => 0x0258,   0x16 => 0x0258,   0x17 => 0x0258,
            0x18 => 0x0258,   0x19 => 0x0258,   0x1a => 0x0258,   0x1b => 0x0258,
            0x1c => 0x0258,   0x1d => 0x0258,   0x1e => 0x0258,   0x1f => 0x0258,
            0x20 => 0x0258,   0x21 => 0x0258,   0x22 => 0x0258,   0x23 => 0x0258,
            0x24 => 0x0258,   0x25 => 0x0258,   0x26 => 0x0258,   0x27 => 0x0258,
            0x28 => 0x0258,   0x29 => 0x0258,   0x2a => 0x0258,   0x2b => 0x0258,
            0x2c => 0x0258,   0x2d => 0x0258,   0x2e => 0x0258,   0x2f => 0x0258,
            0x30 => 0x0258,   0x31 => 0x0258,   0x32 => 0x0258,   0x33 => 0x0258,
            0x34 => 0x0258,   0x35 => 0x0258,   0x36 => 0x0258,   0x37 => 0x0258,
            0x38 => 0x0258,   0x39 => 0x0258,   0x3a => 0x0258,   0x3b => 0x0258,
            0x3c => 0x0258,   0x3d => 0x0258,   0x3e => 0x0258,   0x3f => 0x0258,
            0x40 => 0x0258,   0x41 => 0x0258,   0x42 => 0x0258,   0x43 => 0x0258,
            0x44 => 0x0258,   0x45 => 0x0258,   0x46 => 0x0258,   0x47 => 0x0258,
            0x48 => 0x0258,   0x49 => 0x0258,   0x4a => 0x0258,   0x4b => 0x0258,
            0x4c => 0x0258,   0x4d => 0x0258,   0x4e => 0x0258,   0x4f => 0x0258,
            0x50 => 0x0258,   0x51 => 0x0258,   0x52 => 0x0258,   0x53 => 0x0258,
            0x54 => 0x0258,   0x55 => 0x0258,   0x56 => 0x0258,   0x57 => 0x0258,
            0x58 => 0x0258,   0x59 => 0x0258,   0x5a => 0x0258,   0x5b => 0x0258,
            0x5c => 0x0258,   0x5d => 0x0258,   0x5e => 0x0258,   0x5f => 0x0258,
            0x60 => 0x0258,   0x61 => 0x0258,   0x62 => 0x0258,   0x63 => 0x0258,
            0x64 => 0x0258,   0x65 => 0x0258,   0x66 => 0x0258,   0x67 => 0x0258,
            0x68 => 0x0258,   0x69 => 0x0258,   0x6a => 0x0258,   0x6b => 0x0258,
            0x6c => 0x0258,   0x6d => 0x0258,   0x6e => 0x0258,   0x6f => 0x0258,
            0x70 => 0x0258,   0x71 => 0x0258,   0x72 => 0x0258,   0x73 => 0x0258,
            0x74 => 0x0258,   0x75 => 0x0258,   0x76 => 0x0258,   0x77 => 0x0258,
            0x78 => 0x0258,   0x79 => 0x0258,   0x7a => 0x0258,   0x7b => 0x0258,
            0x7c => 0x0258,   0x7d => 0x0258,   0x7e => 0x0258,   0x7f => 0x0258,
            0x80 => 0x0258,   0x81 => 0x0258,   0x82 => 0x0258,   0x83 => 0x0258,
            0x84 => 0x0258,   0x85 => 0x0258,   0x86 => 0x0258,   0x87 => 0x0258,
            0x88 => 0x0258,   0x89 => 0x0258,   0x8a => 0x0258,   0x8b => 0x0258,
            0x8c => 0x0258,   0x8d => 0x0258,   0x8e => 0x0258,   0x8f => 0x0258,
            0x90 => 0x0258,   0x91 => 0x0258,   0x92 => 0x0258,   0x93 => 0x0258,
            0x94 => 0x0258,   0x95 => 0x0258,   0x96 => 0x0258,   0x97 => 0x0258,
            0x98 => 0x0258,   0x99 => 0x0258,   0x9a => 0x0258,   0x9b => 0x0258,
            0x9c => 0x0258,   0x9d => 0x0258,   0x9e => 0x0258,   0x9f => 0x0258,
            0xa0 => 0x0258,   0xa1 => 0x0258,   0xa2 => 0x0258,   0xa3 => 0x0258,
            0xa4 => 0x0258,   0xa5 => 0x0258,   0xa6 => 0x0258,   0xa7 => 0x0258,
            0xa8 => 0x0258,   0xa9 => 0x0258,   0xaa => 0x0258,   0xab => 0x0258,
            0xac => 0x0258,   0xad => 0x0258,   0xae => 0x0258,   0xaf => 0x0258,
            0xb0 => 0x0258,   0xb1 => 0x0258,   0xb2 => 0x0258,   0xb3 => 0x0258,
            0xb4 => 0x0258,   0xb5 => 0x0258,   0xb6 => 0x0258,   0xb7 => 0x0258,
            0xb8 => 0x0258,   0xb9 => 0x0258,   0xba => 0x0258,   0xbb => 0x0258,
            0xbc => 0x0258,   0xbd => 0x0258,   0xbe => 0x0258,   0xbf => 0x0258,
            0xc0 => 0x0258,   0xc1 => 0x0258,   0xc2 => 0x0258,   0xc3 => 0x0258,
            0xc4 => 0x0258,   0xc5 => 0x0258,   0xc6 => 0x0258,   0xc7 => 0x0258,
            0xc8 => 0x0258,   0xc9 => 0x0258,   0xca => 0x0258,   0xcb => 0x0258,
            0xcc => 0x0258,   0xcd => 0x0258,   0xce => 0x0258,   0xcf => 0x0258,
            0xd0 => 0x0258,   0xd1 => 0x0258,   0xd2 => 0x0258,   0xd3 => 0x0258,
            0xd4 => 0x0258,   0xd5 => 0x0258,   0xd6 => 0x0258,   0xd7 => 0x0258,
            0xd8 => 0x0258,   0xd9 => 0x0258,   0xda => 0x0258,   0xdb => 0x0258,
            0xdc => 0x0258,   0xdd => 0x0258,   0xde => 0x0258,   0xdf => 0x0258,
            0xe0 => 0x0258,   0xe1 => 0x0258,   0xe2 => 0x0258,   0xe3 => 0x0258,
            0xe4 => 0x0258,   0xe5 => 0x0258,   0xe6 => 0x0258,   0xe7 => 0x0258,
            0xe8 => 0x0258,   0xe9 => 0x0258,   0xea => 0x0258,   0xeb => 0x0258,
            0xec => 0x0258,   0xed => 0x0258,   0xee => 0x0258,   0xef => 0x0258,
            0xf0 => 0x0258,   0xf1 => 0x0258,   0xf2 => 0x0258,   0xf3 => 0x0258,
            0xf4 => 0x0258,   0xf5 => 0x0258,   0xf6 => 0x0258,   0xf7 => 0x0258,
            0xf8 => 0x0258,   0xf9 => 0x0258,   0xfa => 0x0258,   0xfb => 0x0258,
            0xfc => 0x0258,   0xfd => 0x0258,   0xfe => 0x0258,   0xff => 0x0258,
          0x0100 => 0x0258, 0x0101 => 0x0258, 0x0102 => 0x0258, 0x0103 => 0x0258,
          0x0104 => 0x0258, 0x0105 => 0x0258, 0x0106 => 0x0258, 0x0107 => 0x0258,
          0x0108 => 0x0258, 0x0109 => 0x0258, 0x010a => 0x0258, 0x010b => 0x0258,
          0x010c => 0x0258, 0x010d => 0x0258, 0x010e => 0x0258, 0x010f => 0x0258,
          0x0110 => 0x0258, 0x0111 => 0x0258, 0x0112 => 0x0258, 0x0113 => 0x0258,
          0x0114 => 0x0258, 0x0115 => 0x0258, 0x0116 => 0x0258, 0x0117 => 0x0258,
          0x0118 => 0x0258, 0x0119 => 0x0258, 0x011a => 0x0258, 0x011b => 0x0258,
          0x011c => 0x0258, 0x011d => 0x0258, 0x011e => 0x0258, 0x011f => 0x0258,
          0x0120 => 0x0258, 0x0121 => 0x0258, 0x0122 => 0x0258, 0x0123 => 0x0258,
          0x0124 => 0x0258, 0x0125 => 0x0258, 0x0126 => 0x0258, 0x0127 => 0x0258,
          0x0128 => 0x0258, 0x0129 => 0x0258, 0x012a => 0x0258, 0x012b => 0x0258,
          0x012c => 0x0258, 0x012d => 0x0258, 0x012e => 0x0258, 0x012f => 0x0258,
          0x0130 => 0x0258, 0x0131 => 0x0258, 0x0132 => 0x0258, 0x0133 => 0x0258,
          0x0134 => 0x0258, 0x0135 => 0x0258, 0x0136 => 0x0258, 0x0137 => 0x0258,
          0x0138 => 0x0258, 0x0139 => 0x0258, 0x013a => 0x0258, 0x013b => 0x0258,
        );

        /* The cmap table is similarly synthesized.
         */
        $cmapData = array(
            0x20 =>   0x01,   0x21 =>   0x02,   0x22 =>   0x03,   0x23 =>   0x04,
            0x24 =>   0x05,   0x25 =>   0x06,   0x26 =>   0x07, 0x2019 =>   0x08,
            0x28 =>   0x09,   0x29 =>   0x0a,   0x2a =>   0x0b,   0x2b =>   0x0c,
            0x2c =>   0x0d,   0x2d =>   0x0e,   0x2e =>   0x0f,   0x2f =>   0x10,
            0x30 =>   0x11,   0x31 =>   0x12,   0x32 =>   0x13,   0x33 =>   0x14,
            0x34 =>   0x15,   0x35 =>   0x16,   0x36 =>   0x17,   0x37 =>   0x18,
            0x38 =>   0x19,   0x39 =>   0x1a,   0x3a =>   0x1b,   0x3b =>   0x1c,
            0x3c =>   0x1d,   0x3d =>   0x1e,   0x3e =>   0x1f,   0x3f =>   0x20,
            0x40 =>   0x21,   0x41 =>   0x22,   0x42 =>   0x23,   0x43 =>   0x24,
            0x44 =>   0x25,   0x45 =>   0x26,   0x46 =>   0x27,   0x47 =>   0x28,
            0x48 =>   0x29,   0x49 =>   0x2a,   0x4a =>   0x2b,   0x4b =>   0x2c,
            0x4c =>   0x2d,   0x4d =>   0x2e,   0x4e =>   0x2f,   0x4f =>   0x30,
            0x50 =>   0x31,   0x51 =>   0x32,   0x52 =>   0x33,   0x53 =>   0x34,
            0x54 =>   0x35,   0x55 =>   0x36,   0x56 =>   0x37,   0x57 =>   0x38,
            0x58 =>   0x39,   0x59 =>   0x3a,   0x5a =>   0x3b,   0x5b =>   0x3c,
            0x5c =>   0x3d,   0x5d =>   0x3e,   0x5e =>   0x3f,   0x5f =>   0x40,
          0x2018 =>   0x41,   0x61 =>   0x42,   0x62 =>   0x43,   0x63 =>   0x44,
            0x64 =>   0x45,   0x65 =>   0x46,   0x66 =>   0x47,   0x67 =>   0x48,
            0x68 =>   0x49,   0x69 =>   0x4a,   0x6a =>   0x4b,   0x6b =>   0x4c,
            0x6c =>   0x4d,   0x6d =>   0x4e,   0x6e =>   0x4f,   0x6f =>   0x50,
            0x70 =>   0x51,   0x71 =>   0x52,   0x72 =>   0x53,   0x73 =>   0x54,
            0x74 =>   0x55,   0x75 =>   0x56,   0x76 =>   0x57,   0x77 =>   0x58,
            0x78 =>   0x59,   0x79 =>   0x5a,   0x7a =>   0x5b,   0x7b =>   0x5c,
            0x7c =>   0x5d,   0x7d =>   0x5e,   0x7e =>   0x5f,   0xa1 =>   0x60,
            0xa2 =>   0x61,   0xa3 =>   0x62, 0x2044 =>   0x63,   0xa5 =>   0x64,
          0x0192 =>   0x65,   0xa7 =>   0x66,   0xa4 =>   0x67,   0x27 =>   0x68,
          0x201c =>   0x69,   0xab =>   0x6a, 0x2039 =>   0x6b, 0x203a =>   0x6c,
          0xfb01 =>   0x6d, 0xfb02 =>   0x6e, 0x2013 =>   0x6f, 0x2020 =>   0x70,
          0x2021 =>   0x71,   0xb7 =>   0x72,   0xb6 =>   0x73, 0x2022 =>   0x74,
          0x201a =>   0x75, 0x201e =>   0x76, 0x201d =>   0x77,   0xbb =>   0x78,
          0x2026 =>   0x79, 0x2030 =>   0x7a,   0xbf =>   0x7b,   0x60 =>   0x7c,
            0xb4 =>   0x7d, 0x02c6 =>   0x7e, 0x02dc =>   0x7f,   0xaf =>   0x80,
          0x02d8 =>   0x81, 0x02d9 =>   0x82,   0xa8 =>   0x83, 0x02da =>   0x84,
            0xb8 =>   0x85, 0x02dd =>   0x86, 0x02db =>   0x87, 0x02c7 =>   0x88,
          0x2014 =>   0x89,   0xc6 =>   0x8a,   0xaa =>   0x8b, 0x0141 =>   0x8c,
            0xd8 =>   0x8d, 0x0152 =>   0x8e,   0xba =>   0x8f,   0xe6 =>   0x90,
          0x0131 =>   0x91, 0x0142 =>   0x92,   0xf8 =>   0x93, 0x0153 =>   0x94,
            0xdf =>   0x95,   0xcf =>   0x96,   0xe9 =>   0x97, 0x0103 =>   0x98,
          0x0171 =>   0x99, 0x011b =>   0x9a, 0x0178 =>   0x9b,   0xf7 =>   0x9c,
            0xdd =>   0x9d,   0xc2 =>   0x9e,   0xe1 =>   0x9f,   0xdb =>   0xa0,
            0xfd =>   0xa1, 0x0219 =>   0xa2,   0xea =>   0xa3, 0x016e =>   0xa4,
            0xdc =>   0xa5, 0x0105 =>   0xa6,   0xda =>   0xa7, 0x0173 =>   0xa8,
            0xcb =>   0xa9, 0x0110 =>   0xaa, 0xf6c3 =>   0xab,   0xa9 =>   0xac,
          0x0112 =>   0xad, 0x010d =>   0xae,   0xe5 =>   0xaf, 0x0145 =>   0xb0,
          0x013a =>   0xb1,   0xe0 =>   0xb2, 0x0162 =>   0xb3, 0x0106 =>   0xb4,
            0xe3 =>   0xb5, 0x0116 =>   0xb6, 0x0161 =>   0xb7, 0x015f =>   0xb8,
            0xed =>   0xb9, 0x25ca =>   0xba, 0x0158 =>   0xbb, 0x0122 =>   0xbc,
            0xfb =>   0xbd,   0xe2 =>   0xbe, 0x0100 =>   0xbf, 0x0159 =>   0xc0,
            0xe7 =>   0xc1, 0x017b =>   0xc2,   0xde =>   0xc3, 0x014c =>   0xc4,
          0x0154 =>   0xc5, 0x015a =>   0xc6, 0x010f =>   0xc7, 0x016a =>   0xc8,
          0x016f =>   0xc9,   0xb3 =>   0xca,   0xd2 =>   0xcb,   0xc0 =>   0xcc,
          0x0102 =>   0xcd,   0xd7 =>   0xce,   0xfa =>   0xcf, 0x0164 =>   0xd0,
          0x2202 =>   0xd1,   0xff =>   0xd2, 0x0143 =>   0xd3,   0xee =>   0xd4,
            0xca =>   0xd5,   0xe4 =>   0xd6,   0xeb =>   0xd7, 0x0107 =>   0xd8,
          0x0144 =>   0xd9, 0x016b =>   0xda, 0x0147 =>   0xdb,   0xcd =>   0xdc,
            0xb1 =>   0xdd,   0xa6 =>   0xde,   0xae =>   0xdf, 0x011e =>   0xe0,
          0x0130 =>   0xe1, 0x2211 =>   0xe2,   0xc8 =>   0xe3, 0x0155 =>   0xe4,
          0x014d =>   0xe5, 0x0179 =>   0xe6, 0x017d =>   0xe7, 0x2265 =>   0xe8,
            0xd0 =>   0xe9,   0xc7 =>   0xea, 0x013c =>   0xeb, 0x0165 =>   0xec,
          0x0119 =>   0xed, 0x0172 =>   0xee,   0xc1 =>   0xef,   0xc4 =>   0xf0,
            0xe8 =>   0xf1, 0x017a =>   0xf2, 0x012f =>   0xf3,   0xd3 =>   0xf4,
            0xf3 =>   0xf5, 0x0101 =>   0xf6, 0x015b =>   0xf7,   0xef =>   0xf8,
            0xd4 =>   0xf9,   0xd9 =>   0xfa, 0x2206 =>   0xfb,   0xfe =>   0xfc,
            0xb2 =>   0xfd,   0xd6 =>   0xfe,   0xb5 =>   0xff,   0xec => 0x0100,
          0x0151 => 0x0101, 0x0118 => 0x0102, 0x0111 => 0x0103,   0xbe => 0x0104,
          0x015e => 0x0105, 0x013e => 0x0106, 0x0136 => 0x0107, 0x0139 => 0x0108,
          0x2122 => 0x0109, 0x0117 => 0x010a,   0xcc => 0x010b, 0x012a => 0x010c,
          0x013d => 0x010d,   0xbd => 0x010e, 0x2264 => 0x010f,   0xf4 => 0x0110,
            0xf1 => 0x0111, 0x0170 => 0x0112,   0xc9 => 0x0113, 0x0113 => 0x0114,
          0x011f => 0x0115,   0xbc => 0x0116, 0x0160 => 0x0117, 0x0218 => 0x0118,
          0x0150 => 0x0119,   0xb0 => 0x011a,   0xf2 => 0x011b, 0x010c => 0x011c,
            0xf9 => 0x011d, 0x221a => 0x011e, 0x010e => 0x011f, 0x0157 => 0x0120,
            0xd1 => 0x0121,   0xf5 => 0x0122, 0x0156 => 0x0123, 0x013b => 0x0124,
            0xc3 => 0x0125, 0x0104 => 0x0126,   0xc5 => 0x0127,   0xd5 => 0x0128,
          0x017c => 0x0129, 0x011a => 0x012a, 0x012e => 0x012b, 0x0137 => 0x012c,
          0x2212 => 0x012d,   0xce => 0x012e, 0x0148 => 0x012f, 0x0163 => 0x0130,
            0xac => 0x0131,   0xf6 => 0x0132,   0xfc => 0x0133, 0x2260 => 0x0134,
          0x0123 => 0x0135,   0xf0 => 0x0136, 0x017e => 0x0137, 0x0146 => 0x0138,
            0xb9 => 0x0139, 0x012b => 0x013a, 0x20ac => 0x013b);
        #require_once 'Zend/Pdf/Cmap.php';
        $this->_cmap = Zend_Pdf_Cmap::cmapWithTypeData(
            Zend_Pdf_Cmap::TYPE_BYTE_ENCODING_STATIC, $cmapData);


        /* Resource dictionary */

        /* The resource dictionary for the standard fonts is sparse because PDF
         * viewers already have all of the metrics data. We only need to provide
         * the font name and encoding method.
         */
        $this->_resource->BaseFont = new Zend_Pdf_Element_Name('Courier');
    }
}
