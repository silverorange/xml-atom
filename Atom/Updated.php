<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Date.php';

/**
 * A class used to generate a updated date node.
 *
 * @package   XML_Atom
 * @copyright 2008-2013 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Updated extends XML_Atom_Date
{
    // {{{ protected function _createNode()

    /**
     * Creates a updated date node
     *
     * @param DOMNode $context_node the parent node that will contain this
     *                              updated date node.
     *
     * @return DOMNode the new updated date node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NS, 'updated');
    }

    // }}}
}

?>
