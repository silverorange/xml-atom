<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'Date.php';
require_once 'XML/Atom/Element.php';

/**
 * Date
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class XML_Atom_Date extends XML_Atom_Element
{
    // {{{ protected properties

    protected $_date;

    // }}}
    // {{{ public function __construct()

    public function __construct($date)
    {
        $this->setDate($date);
    }

    // }}}
    // {{{ public function setDate()

    public function setDate($date)
    {
        if (!($date instanceof Date)) {
            $date = new Date($date);
        }

        $this->_date = $date;
    }

    // }}}
    // {{{ protected function _buildNode()

    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $date_string = $this->_date->getDate(DATE_FORMAT_ISO_EXTENDED);
        $text_node = $document->createTextNode($date_string);

        $node->appendChild($text_node);
    }

    // }}}
}

?>
