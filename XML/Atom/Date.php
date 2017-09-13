<?php

/**
 * Element class definition.
 */

/**
 * Abstract base class used to describe a date in an Atom document
 *
 * This class is an Atom wrapper for a PEAR Date object.
 *
 * @category  XML
 * @package   XML_Atom
 * @author    Michael Gauthier <mike@silverorange.com>
 * @copyright 2008-2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @link      https://github.com/silverorange/xml-atom
 */
abstract class XML_Atom_Date extends XML_Atom_Element
{
    // {{{ protected properties

    /**
     * The date represented by this element
     *
     * @var DateTime
     *
     * @see XML_Atom_Date::setDate()
     */
    protected $date;

    // }}}
    // {{{ public function __construct()

    /**
     * Creates a new Date
     *
     * @param string|DateTime $date the date to use. This can be either an
     *                                 already constructed DateTime object
     *                                 or a textual representation of a date
     *                                 that can be parsed by the DateTime
     *                                 class.
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
     * @param string|DateTime $date the date to use. This can be either an
     *                                 already constructed DateTime object
     *                                 or a textual representation of a date
     *                                 that can be parsed by the DateTime
     *                                 class.
     *
     * @return void
     */
    public function setDate($date)
    {
        if (!$date instanceof DateTime) {
            $date = new DateTime($date);
        }

        $this->date = $date;
    }

    // }}}
    // {{{ protected function buildNode()

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
    protected function buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $date_string = $this->date->format('c');
        $text_node = $document->createTextNode($date_string);

        $node->appendChild($text_node);
    }

    // }}}
}

?>
