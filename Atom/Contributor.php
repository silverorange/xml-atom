<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Person class definition.
 */
require_once 'XML/Atom/Person.php';

// {{{ class XML_Atom_Contributor

/**
 * An {@link XML_Atom_Person} that indicates a contributor to an entry or feed
 *
 * Contributors may represent people, corporations or other similar entities.
 *
 * Feeds or entries may have any number of contributors. If an entry does not
 * have contributors, the contributors of the parent feed or source apply to
 * the entry.
 *
 * @category  XML
 * @package   XML_Atom
 * @author    Michael Gauthier <mike@silverorange.com>
 * @copyright 2008-2013 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @link      http://pear.php.net/package/XML_Atom
 * @see       XML_Atom_Entry::addContributor()
 * @see       XML_Atom_Feed::addContributor()
 */
class XML_Atom_Contributor extends XML_Atom_Person
{
    // {{{ protected function _createNode()

    /**
     * Creates a contributor DOMElement node for this contributor
     *
     * @param DOMNode $context_node the context node in the XML document used
     *                              to create this node.
     *
     * @return DOMNode the author DOMElement node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NS, 'contributor');
    }

    // }}}
}

// }}}

?>
