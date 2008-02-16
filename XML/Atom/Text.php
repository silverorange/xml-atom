<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

abstract class XML_Atom_Text extends XML_Atom_Element
{
    protected $_text = '';
    protected $_type = '';

    public function __construct($text, $type = 'text', $language = '')
    {
        $this->setText($text);
        $this->setType($type);
        $this->setLanguage($language);
    }

    public function setText($text)
    {
        $this->_text = strval($text);
    }

    public function setType($type)
    {
        $this->_type = strval($type);
    }

    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $node->setAttribute('type', $this->_type);

        $cdata_node = $document->createCDATASection($this->_text);
        $node->appendChild($cdata_node);
    }
}

?>
