<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

/**
 * Link
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Link extends XML_Atom_Element
{
    // {{{ protected properties

    protected $_href = '';
    protected $_rel = '';
    protected $_type = '';
    protected $_hreflang = '';
    protected $_title = '';
    protected $_length = null;

    // }}}
    // {{{ public function __construct()

    public function __construct($href, $hreflang = '')
    {
        $this->setHref($href);
        $this->setHrefLanguage($hreflang);
    }

    // }}}
    // {{{ public function setHref()

    public function setHref($href)
    {
        $this->_href = strval($href);
    }

    // }}}
    // {{{ public function setHrefLanguage()

    public function setHrefLanguage($hreflang)
    {
        $this->_hreflang = strval($hreflang);
    }

    // }}}
    // {{{ public function setRelation()

    public function setRelation($rel)
    {
        $this->_rel = strval($rel);
    }

    // }}}
    // {{{ public function setType()

    public function setType($type)
    {
        $this->_type = strval($type);
    }

    // }}}
    // {{{ public function setTitle()

    public function setTitle($title)
    {
        $this->_title = strval($title);
    }

    // }}}
    // {{{ public function setLength()

    public function setLength($length)
    {
        if ($length !== null) {
            $length = intval($length);
        }

        $this->_length = $length;
    }

    // }}}
    // {{{ protected function _createNode()

    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NAMESPACE, 'link');
    }

    // }}}
    // {{{ protected function _buildNode()

    protected function _buildNode(DOMNode $node)
    {
        $node->setAttributeNS(XML_Atom_Node::NAMESPACE, 'href', $this->_href);

        if ($this->_rel != '') {
            $node->setAttributeNS(XML_Atom_Node::NAMESPACE, 'rel', $this->_rel);
        }

        if ($this->_type != '') {
            $node->setAttributeNS(XML_Atom_Node::NAMESPACE, 'type',
                $this->_type);
        }

        if ($this->_hreflang != '') {
            $node->setAttributeNS(XML_Atom_Node::NAMESPACE, 'hreflang',
                $this->_hreflang);
        }

        if ($this->_title != '') {
            $node->setAttributeNS(XML_Atom_Node::NAMESPACE, 'title',
                $this->_title);
        }

        if ($this->_length !== null) {
            $node->setAttributeNS(XML_Atom_Node::NAMESPACE, 'length',
                $this->_length);
        }
    }

    // }}}
}

?>
