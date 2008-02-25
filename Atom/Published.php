<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Date.php';

/**
 * A class used to used to generate a published date node.
 *
 * @package   XML_Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Published extends XML_Atom_Date
{
    // {{{ protected function _createNode()

    /**
     * Creates a published node
     *
     * @param DOMNode $context_node the parent node that will contain this
     *   published node.
     *
     * @return DOMNode the new published node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NAMESPACE,
            'published');
    }

    // }}}
}

?>
