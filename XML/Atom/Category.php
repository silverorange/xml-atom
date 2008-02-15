<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

class XML_Atom_Category extends XML_Atom_Element
{
    protected $_term = '';
    protected $_scheme = '';
    protected $_label = '';

    public function __construct($term, $scheme = '', $label = '',
        $laguage = '')
    {
        $this->setTerm($term);
        $this->setScheme($scheme);
        $this->setLabel($label, $language);
    }

    public function setTerm($term)
    {
        $this->_term = strval($term);
    }

    public function setScheme($scheme)
    {
        $this->_scheme = strval($scheme);
    }

    public function setLabel($label, $language = '')
    {
        $this->_label = strval($label);
        $this->setLanguage($language);
    }

    protected function _createNode(DOMDocument $document)
    {
        return $document->createElement('category');
    }

    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $node->setAttribute('term', $this->_term);

        if ($this->_scheme != '') {
            $node->setAttribute('scheme', $this->_scheme);
        }

        if ($this->_label != '') {
            $node->setAttribute('label', $this->_label);
        }
    }
}

?>
