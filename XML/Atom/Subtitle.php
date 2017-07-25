<?php

require_once 'XML/Atom/Text.php';

/**
 * A class used to generate a subtitle node.
 *
 * @package   XML_Atom
 * @copyright 2008-2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @link      https://github.com/silverorange/xml-atom
 */
class XML_Atom_Subtitle extends XML_Atom_Text
{
    // {{{ protected function createNode()

    /**
     * Creates a subtitle node
     *
     * @param DOMNode $context_node the parent node that will contain this
     *                              subtitle node.
     *
     * @return DOMNode the new subtitle node.
     */
    protected function createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NS, 'subtitle');
    }

    // }}}
}

?>
