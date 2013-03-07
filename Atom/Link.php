<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

/**
 * A class used to generate a link node.
 *
 * @package   XML_Atom
 * @copyright 2008-2013 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Link extends XML_Atom_Element
{
    // {{{ protected properties

    /**
     * The href of this node
     *
     * @var string
     */
    protected $_href = '';

    /**
     * The relation of this node
     *
     * @var string
     */
    protected $_rel = '';

    /**
     * The type of this node
     *
     * @var string
     */
    protected $_type = '';

    /**
     * The href language of this node
     *
     * @var string
     */
    protected $_hreflang = '';

    /**
     * The title of this node
     *
     * @var string
     */
    protected $_title = '';

    /**
     * The length of this node
     *
     * @var string
     */
    protected $_length = null;

    // }}}
    // {{{ public function __construct()

    /**
     * Contructs this XML_Atom_Link
     *
     * @param string $href     the href to use.
     * @param string $hreflang the href language to use.
     */
    public function __construct($href, $rel = '', $type = '', $hreflang = '')
    {
        $this->setHref($href);
        $this->setRelation($rel);
        $this->setType($type);
        $this->setHrefLanguage($hreflang);
    }

    // }}}
    // {{{ public function setHref()

    /**
     * Sets the href of this node.
     *
     * @param string $href the href to set this node to.
     *
     * @return void
     */
    public function setHref($href)
    {
        $this->_href = strval($href);
    }

    // }}}
    // {{{ public function setHrefLanguage()

    /**
     * Sets the href language of this node.
     *
     * @param string $hreflang the href language to set this node to.
     *
     * @return void
     */
    public function setHrefLanguage($hreflang)
    {
        $this->_hreflang = strval($hreflang);
    }

    // }}}
    // {{{ public function setRelation()

    /**
     * Sets the relation of this node.
     *
     * @param string $relation the relation to set this node to.
     *
     * @return void
     */
    public function setRelation($rel)
    {
        $this->_rel = strval($rel);
    }

    // }}}
    // {{{ public function setType()

    /**
     * Sets the type for this node.
     *
     * @param string $type the type to set this node to.
     *
     * @return void
     */
    public function setType($type)
    {
        $this->_type = strval($type);
    }

    // }}}
    // {{{ public function setTitle()

    /**
     * Sets the title of this node.
     *
     * @param string $title the title to set this node to.
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->_title = strval($title);
    }

    // }}}
    // {{{ public function setLength()

    /**
     * Sets the length of this node.
     *
     * @param string $length the length to set this node to.
     *
     * @return void
     */
    public function setLength($length)
    {
        if ($length !== null) {
            $length = intval($length);
        }

        $this->_length = $length;
    }

    // }}}
    // {{{ protected function _createNode()

    /**
     * Creates a link node
     *
     * @param DOMNode $context_node the parent node that will contain this
     *                              link node.
     *
     * @return DOMNode the new link node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NS, 'link');
    }

    // }}}
    // {{{ protected function _buildNode()

    /**
     * Builds all the XML information contained inside this link node.
     *
     * @param DOMNode $node the link node that will contain the XML generated
     *                      by this node.
     *
     * @return void
     */
    protected function _buildNode(DOMNode $node)
    {
        $node->setAttributeNS(XML_Atom_Node::NS, 'href', $this->_href);

        if ($this->_rel != '') {
            $node->setAttributeNS(XML_Atom_Node::NS, 'rel', $this->_rel);
        }

        if ($this->_type != '') {
            $node->setAttributeNS(XML_Atom_Node::NS, 'type', $this->_type);
        }

        if ($this->_hreflang != '') {
            $node->setAttributeNS(
                XML_Atom_Node::NS,
                'hreflang',
                $this->_hreflang
            );
        }

        if ($this->_title != '') {
            $node->setAttributeNS(XML_Atom_Node::NS, 'title', $this->_title);
        }

        if ($this->_length !== null) {
            $node->setAttributeNS(XML_Atom_Node::NS, 'length', $this->_length);
        }
    }

    // }}}
}

?>
