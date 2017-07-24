<?php

/**
 * Person class definition.
 */
require_once 'XML/Atom/Person.php';

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
 * @copyright 2008-2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @link      https://github.com/silverorange/xml-atom
 * @see       XML_Atom_Entry::addContributor()
 * @see       XML_Atom_Feed::addContributor()
 */
class XML_Atom_Contributor extends XML_Atom_Person
{
    // {{{ protected function createNode()

    /**
     * Creates a contributor DOMElement node for this contributor
     *
     * @param DOMNode $context_node the context node in the XML document used
     *                              to create this node.
     *
     * @return DOMNode the author DOMElement node.
     */
    protected function createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NS, 'contributor');
    }

    // }}}
}

?>
