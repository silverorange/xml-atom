<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Node.php';

abstract class XML_Atom_Element extends XML_Atom_Node
{
    protected $_language = '';
    protected $_base = '';
    protected $_namespaces = array();

    public function setBase($base)
    {
        $this->_base = strval($base);
    }

    public function setLanguage($language)
    {
        $this->_language = strval($language);
    }

    public function addNamespace($prefix, $uri)
    {
        $this->_namespaces[strval($prefix)] = strval($uri);
    }

    protected function _buildNamespaces(DOMNode $node)
    {
        foreach ($this->_namespaces as $prefix => $uri) {
            $node->setAttribute('xmlns:'.$prefix, $uri);
        }
    }

    protected function _buildCommonAttributes(DOMNode $node)
    {
        if ($this->_base != '') {
            $node->setAttribute('xml:base', $this->base);
        }

        if ($this->_language != '') {
            $node->setAttribute('xml:lang', $this->language);
        }
    }

    protected function _getNode(DOMNode $context_node)
    {
        $node = $this->_createNode($context_node);

        $this->_buildNamespaces($node);
        $this->_buildCommonAttributes($node);
        $this->_buildNode($node);
        $this->_buildExtensionNodes($node);

        return $node;
    }

    protected function _buildExtensionNodes(DOMNode $node)
    {
    }
}

?>
