<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'Date.php';
require_once 'XML/Atom/Element.php';

/**
 * A class used to generate a date node.
 *
 * @package   XML_Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class XML_Atom_Date extends XML_Atom_Element
{
    // {{{ protected properties

    /**
     * The date of this node
     *
     * @var Date
     */
    protected $_date;

    // }}}
    // {{{ public function __construct()

    /**
     * Contructs this XML_Atom_Person
     *
     * @param string $date the date to use.
     */
    public function __construct($date)
    {
        $this->setDate($date);
    }

    // }}}
    // {{{ public function setDate()

    /**
     * Sets the date of this node
     *
     * @param mixed $date the date this node should use.
     */
    public function setDate($date)
    {
        if (!($date instanceof Date)) {
            $date = new Date($date);
        }

        $this->_date = $date;
    }

    // }}}
    // {{{ protected function _buildNode()

    /**
     * Builds all the XML information contained inside a date node.
     *
     * @param DOMNode $node the date node that will contain all the XML created
     *   by this node.
     */
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
