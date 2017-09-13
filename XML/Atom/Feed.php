<?php

/**
 * A class used to generate all the entires in a feed.
 *
 * @package   XML_Atom
 * @copyright 2008-2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @link      https://github.com/silverorange/xml-atom
 */
class XML_Atom_Feed extends XML_Atom_Source
{
    // {{{ protected properties

    /**
     * The entries for this feed.
     *
     * @var array()
     */
    protected $entries = array();

    // }}}
    // {{{ public function addEntry()

    /**
     * Adds an entry to this feed
     *
     * @param XML_Atom_Entry $entry the entry to be added.
     */
    public function addEntry(XML_Atom_Entry $entry)
    {
        $this->entries[] = $entry;
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

        $this->getNode($feed);

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
            $this->id,
            $this->title,
            $this->updated
        );

        $source->setSubTitle($this->sub_title);
        $source->setIcon($this->icon);
        $source->setLogo($this->logo);
        $source->setRights($this->rights);
        $source->setGenerator($this->generator);

        foreach ($this->authors as $author) {
            $source->addAuthor($author);
        }

        foreach ($this->contributors as $contributor) {
            $source->addContributor($contributor);
        }

        foreach ($this->categories as $category) {
            $source->addCategory($category);
        }

        foreach ($this->links as $link) {
            $source->addLink($link);
        }
    }

    // }}}
    // {{{ protected function buildNode()

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
    protected function buildNode(DOMNode $node)
    {
        parent::buildNode($node);

        foreach ($this->entries as $entry) {
            $node->appendChild($entry->getNode($node));
        }
    }

    // }}}
    // {{{ protected function createNode()

    /**
     * Gets a built copy of the current node.
     *
     * @param DOMNode $context_node the parent node to this node.
     *
     * @return DOMNode a build copy of the current node.
     */
    protected function createNode(DOMNode $context_node)
    {
        return $context_node;
    }

    // }}}
}

?>
