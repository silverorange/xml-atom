<?php

require_once 'XML/Atom/Date.php';

/**
 * A class used to generate a updated date node.
 *
 * @package   XML_Atom
 * @copyright 2008-2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @link      https://github.com/silverorange/xml-atom
 */
class XML_Atom_Updated extends XML_Atom_Date
{
    // {{{ protected function createNode()

    /**
     * Creates a updated date node
     *
     * @param DOMNode $context_node the parent node that will contain this
     *                              updated date node.
     *
     * @return DOMNode the new updated date node.
     */
    protected function createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NS, 'updated');
    }

    // }}}
}

?>
