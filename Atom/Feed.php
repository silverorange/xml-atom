<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Entry.php';
require_once 'XML/Atom/Source.php';

/**
 * A class used to generate all the entires in a feed.
 *
 * @package   XML_Atom
 * @copyright 2008-2013 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Feed extends XML_Atom_Source
{
    // {{{ protected properties

    /**
     * The entries for this feed.
     *
     * @var array()
     */
    protected $_entries = array();

    // }}}
    // {{{ public function addEntry()

    /**
     * Adds an entry to this feed
     *
     * @param XML_Atom_Entry $entry the entry to be added.
     */
    public function addEntry(XML_Atom_Entry $entry)
    {
        $this->_entries[] = $entry;
    }

    // }}}
    // {{{ public function getDocument()

    /**
     * Gets the XML document for this feed
     *
     * @param string $encoding the encoding of this document.
     * @pamam string $prefix
     *
     * @return DOMDocument the XML docuemnt for this feed.
     */
    public function getDocument($encoding = 'utf-8', $prefix = '')
    {
        $document = new DOMDocument('1.0', $encoding);
        $document->formatOutput = true;

        $name = (strlen($prefix) > 0) ? $prefix . ':feed' : 'feed';
        $feed = $document->createElementNS(XML_Atom_Node::NS, $name);
        $document->appendChild($feed);

        $this->_getNode($feed);

        return $document;
    }

    // }}}
    // {{{ public function __toString()

    public function __toString()
    {
        $document = $this->getDocument();
        return $document->saveXML();
    }

    // }}}
    // {{{ public function toSource()

    public function toSource()
    {
        $source = new XML_Atom_Source(
            $this->_id,
            $this->_title,
            $this->_updated
        );

        $source->setSubTitle($this->_sub_title);
        $source->setIcon($this->_icon);
        $source->setLogo($this->_logo);
        $source->setRights($this->_rights);
        $source->setGenerator($this->_generator);

        foreach ($this->_authors as $author) {
            $source->addAuthor($author);
        }

        foreach ($this->_contributors as $contributor) {
            $source->addContributor($contributor);
        }

        foreach ($this->_categories as $category) {
            $source->addCategory($category);
        }

        foreach ($this->_links as $link) {
            $source->addLink($link);
        }
    }

    // }}}
    // {{{ protected function _buildNode()

    /**
     * Builds all the XML information contained inside this node
     *
     * Adds each entry contained in this node to the parent node.
     *
     * @param DOMNode $node the parent node that will contain the XML generated
     *                      by this node.
     *
     * @return void
     */
    protected function _buildNode(DOMNode $node)
    {
        parent::_buildNode($node);

        foreach ($this->_entries as $entry) {
            $node->appendChild($entry->_getNode($node));
        }
    }

    // }}}
    // {{{ protected function _createNode()

    /**
     * Gets a built copy of the current node.
     *
     * @param DOMNode $context_node the parent node to this node.
     *
     * @return DOMNode a build copy of the current node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        return $context_node;
    }

    // }}}
}

?>
