<?php

/**
 * A class used to generate a content node.
 *
 * @category  XML
 * @package   XML_Atom
 * @copyright 2008-2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @link      https://github.com/silverorange/xml-atom
 */
class XML_Atom_Content extends XML_Atom_Text
{
    // {{{ protected function createNode()

    /**
     * Creates a content DOMElement node for this content
     *
     * @param DOMNode $context_node the context node in the XML document used
     *                              to create this node.
     *
     * @return DOMNode the content DOMElement node.
     */
    protected function createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NS, 'content');
    }

    // }}}
    // {{{ protected function buildNode()

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
    protected function buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $node->setAttributeNS(XML_Atom_Node::NS, 'type', $this->type);

        $cdata_node = $document->createCDATASection($this->text);
        $node->appendChild($cdata_node);
    }

    // }}}
}

?>
