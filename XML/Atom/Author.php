<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Person.php';

/**
 * Author
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Author extends XML_Atom_Person
{
    // {{{ protected function _createNode()

    /**
     * Create an author node
     *
     * @param DOMNode $context_node the parent node that will contain this
     *   author node.
     *
     * @return DOMNode the new author node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NAMESPACE, 'author');
    }

    // }}}
}

?>
