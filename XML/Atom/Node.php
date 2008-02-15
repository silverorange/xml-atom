<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

abstract class XML_Atom_Node
{
    const NAMESPACE = 'http://www.w3.org/2005/Atom';

    abstract protected function _createNode(DOMDocument $document);

    abstract protected function _buildNode(DOMNode $node);

    protected function _getNode(DOMDocument $document)
    {
        $node = $this->createNode($document);
        $this->buildNode($node);
        return $node;
    }
}

?>
