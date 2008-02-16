<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Entry.php';
require_once 'XML/Atom/Source.php';

class XML_Atom_Feed extends XML_Atom_Source
{
    protected $_entries = array();

    public function addEntry(XML_Atom_Entry $entry)
    {
        $this->_entries[] = $entry;
    }

    public function getDocument($encoding = 'utf-8')
    {
        $implementation = new DOMImplementation();
        $document = $implementation->createDocument(
            XML_Atom_Node::NAMESPACE, 'feed');

        $document->encoding = $encoding;

        $document_element = $this->_getNode($document);

        return $document;
    }

    public function __toString()
    {
        $document = $this->getDocument();
        return $document->saveXML();
    }

    public function toSource()
    {
        $source = new XML_Atom_Source($this->_id, $this->_title,
            $this->_updated);

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

    protected function _buildNode(DOMNode $node)
    {
        parent::_buildNode($node);

        $document = $node->ownerDocument;

        foreach ($this->_entries as $entry) {
            $node->appendChild($entry->_getNode($document));
        }
    }

    protected function _createNode(DOMDocument $document)
    {
        return $document->documentElement;
    }
}

?>
