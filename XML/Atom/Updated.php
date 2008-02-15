<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Date.php';

class XML_Atom_Updated extends XML_Atom_Date
{
    protected function _createNode(DOMDocument $document)
    {
        return $document->createElement('updated');
    }
}

?>
