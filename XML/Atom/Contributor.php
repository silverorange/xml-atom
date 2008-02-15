<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Person.php';

class XML_Atom_Contributor extends XML_Atom_Person
{
    protected function _createNode(DOMDocument $document)
    {
        return $document->createElement('contributor');
    }
}

?>
