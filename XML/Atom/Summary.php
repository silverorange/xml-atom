<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Text.php';

/**
 * Summary
 *
 * @package   XML_Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Summary extends XML_Atom_Text
{
    // {{{ protected function _createNode()

    /**
     * Creates a summary node
     *
     * @param DOMNode $context_node the parent node that will contain this
     *   summary node.
     *
     * @return DOMNode the summary date node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NAMESPACE, 'summary');
    }

    // }}}
}

?>
