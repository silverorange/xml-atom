<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Text.php';

/**
 * A class used to generate a content node.
 *
 * @package   XML_Atom
 * @copyright 2008-2013 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Content extends XML_Atom_Text
{
    // {{{ protected function _createNode()

    /**
     * Creates a content DOMElement node for this content
     *
     * @param DOMNode $context_node the context node in the XML document used
     *                              to create this node.
     *
     * @return DOMNode the content DOMElement node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NS, 'content');
    }

    // }}}
    // {{{ protected function _buildNode()

    /**
     * Builds and creates the Atom XML nodes required by this content
     *
     * The element node representing this content is created separately and
     * passed as the first parameter of this method.
     *
     * The text content of this content is created as a CDATA section.
     *
     * @param DOMNode $node the node representing this content. Extra nodes
     *                      should be created and added to this node.
     *
     * @return void
     */
    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $node->setAttributeNS(XML_Atom_Node::NS, 'type', $this->_type);

        $cdata_node = $document->createCDATASection($this->_text);
        $node->appendChild($cdata_node);
    }

    // }}}
}

?>
