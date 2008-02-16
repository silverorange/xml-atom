<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Text.php';

class XML_Atom_Title extends XML_Atom_Text
{
    protected function _createNode(DOMDocument $document)
    {
        return $document->createElement('title');
    }
}

?>
