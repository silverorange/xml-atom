<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Text.php';

/**
 * Title
 *
 * @package   XML_Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Title extends XML_Atom_Text
{
    // {{{ protected function _createNode()

    /**
     * Creates a text node
     *
     * @param DOMNode $context_node the parent node that will contain this
     *   text node.
     *
     * @return DOMNode the new text node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NAMESPACE, 'title');
    }

    // }}}
}

?>
