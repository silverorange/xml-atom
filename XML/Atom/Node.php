<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

abstract class XML_Atom_Node
{
    const NAMESPACE = 'http://www.w3.org/2005/Atom';

    abstract protected function _createNode(DOMDocument $document);

    abstract protected function _buildNode(DOMNode $node);

    protected function _getNode(DOMNode $context_node)
    {
        $node = $this->_createNode($context_node);
        $this->_buildNode($node);
        return $node;
    }

    protected function _getAtomNodeName(DOMNode $context_node, $name)
    {
        $prefix = $context_node->lookupPrefix(AtomNode::NAMESPACE);
        return = ($prefix === null) ? $name : $prefix . ':' . $name;
    }
}

?>
