<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * PEAR Date class definitions.
 */
require_once 'Date.php';

/**
 * Element class definition.
 */
require_once 'XML/Atom/Element.php';

// {{{ class XML_Atom_Date

/**
 * Abstract base class used to describe a date in an Atom document
 *
 * This class is an Atom wrapper for a PEAR Date object.
 *
 * @category  XML
 * @package   XML_Atom
 * @author    Michael Gauthier <mike@silverorange.com>
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @link      http://pear.php.net/package/XML_Atom
 */
abstract class XML_Atom_Date extends XML_Atom_Element
{
    // {{{ protected properties

    /**
     * The date represented by this element
     *
     * @var Date
     *
     * @see XML_Atom_Date::setDate()
     */
    protected $_date;

    // }}}
    // {{{ public function __construct()

    /**
     * Creates a new Date
     *
     * @param string|Date $date the date to use. This can be either an already
     *                          constructed Date object or a textual
     *                          representation of a Date that can be parsed by
     *                          the Date class.
     */
    public function __construct($date)
    {
        $this->setDate($date);
    }

    // }}}
    // {{{ public function setDate()

    /**
     * Sets the date of this date element
     *
     * @param string|Date $date the date to use. This can be either an already
     *                          constructed Date object or a textual
     *                          representation of a Date that can be parsed by
     *                          the Date class.
     *
     * @return void
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
    /**
     * Builds and creates the Atom XML nodes required by this date
     *
     * The element node representing this date is created separately and
     * passed as the first parameter of this method.
     *
     * @param DOMNode $node the node representing this date.
     *
     * @return void
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

// }}}

?>
