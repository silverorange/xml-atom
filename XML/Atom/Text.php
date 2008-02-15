<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

abstract class XML_Atom_Text extends XML_Atom_Element
{
    protected $_content = '';
    protected $_type = '';

    public function __construct($content, $type = 'text', $language = '')
    {
        $this->setContent($content);
        $this->setType($type);
        $this->setLanguage($language);
    }

    public function setContent($content)
    {
        $this->_content = strval($content);
    }

    public function setType($type)
    {
        $this->_type = strval($type);
    }

    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $node->setAttribute('type', $this->_type);

        $cdata_node = $document->createCDATASection($this->_content);
        $node->appendChild($cdata_node);
    }
}

?>
