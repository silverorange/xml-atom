<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

class XML_Atom_Link extends XML_Atom_Element
{
    protected $_href = '';
    protected $_rel = '';
    protected $_type = '';
    protected $_hreflang = '';
    protected $_title = '';
    protected $_length = null;

    public function __construct($href, $hreflang = '')
    {
        $this->setHref($href);
        $this->setHrefLanguage($hreflang);
    }

    public function setHref($href)
    {
        $this->_href = strval($href);
    }

    public function setHrefLanguage($hreflang)
    {
        $this->_hreflang = strval($hreflang);
    }

    public function setRelation($rel)
    {
        $this->_rel = strval($rel);
    }

    public function setType($type)
    {
        $this->_type = strval($type);
    }

    public function setTitle($title)
    {
        $this->_title = strval($title);
    }

    public function setLength($length)
    {
        if ($length !== null) {
            $length = intval($length);
        }

        $this->_length = $length;
    }

    protected function _createNode(DOMDocument $document)
    {
        return $document->createElement('link');
    }

    protected function _buildNode(DOMNode $node)
    {
        $node->setAttribute('href', $this->_href);

        if ($this->_rel != '') {
            $node->setAttribute('rel', $this->_rel);
        }

        if ($this->_type != '') {
            $node->setAttribute('type', $this->_type);
        }

        if ($this->_hreflang != '') {
            $node->setAttribute('hreflang', $this->_hreflang);
        }

        if ($this->_title != '') {
            $node->setAttribute('title', $this->_title);
        }

        if ($this->_length !== null) {
            $node->setAttribute('length', $this->_length);
        }
    }
}

?>
