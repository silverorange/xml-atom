<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Date.php';

/**
 * Published
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Published extends XML_Atom_Date
{
    // {{{ protected function _createNode()

    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElement(
            $this->_getAtomNodeName($context_node, 'published'));
    }

    // }}}
}

?>
