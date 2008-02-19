<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

/**
 * Text
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class XML_Atom_Text extends XML_Atom_Element
{
    // {{{ protected properties

    /**
     * The text of this node
     *
     * @var string
     */
    protected $_text = '';

    /**
     * The type of this node
     *
     * @var string
     */
    protected $_type = '';

    // }}}
    // {{{ public function __construct()

    /**
     * Contruct this XML_Atom_Text
     *
     * @param string $text the text to use.
     * @param string $type the type to use.
     * @param string $language the langauge to use.
     */
    public function __construct($text, $type = 'text', $language = '')
    {
        $this->setText($text);
        $this->setType($type);
        $this->setLanguage($language);
    }

    // }}}
    // {{{ public function setText()

    /**
     * Set the text of this node
     *
     * @param string $text the text this node should use.
     */
    public function setText($text)
    {
        $this->_text = strval($text);
    }

    // }}}
    // {{{ public function setType()

    /**
     * Set the type of this node
     *
     * @param string $type the type this node should use.
     */
    public function setType($type)
    {
        $this->_type = strval($type);
    }

    // }}}
    // {{{ protected function _buildNode()

    /**
     * Build all the XML information contained inside a text node.
     *
     * @param DOMNode $node the text node that will contain all the XML created
     *   by this node.
     */
    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $node->setAttributeNS(XML_Atom_Node::NAMESPACE, 'type', $this->_type);

        $cdata_node = $document->createCDATASection($this->_text);
        $node->appendChild($cdata_node);
    }

    // }}}
}

?>
