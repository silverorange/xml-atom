<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Entry.php';
require_once 'XML/Atom/Source.php';

/**
 * Feed
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Feed extends XML_Atom_Source
{
    // {{{ protected properties

    protected $_entries = array();

    // }}}
    // {{{ public function addEntry()

    public function addEntry(XML_Atom_Entry $entry)
    {
        $this->_entries[] = $entry;
    }

    // }}}
    // {{{ public function getDocument()

    public function getDocument($encoding = 'utf-8', $prefix = '')
    {
        $document = new DOMDocument('1.0', $encoding);

        $name = (strlen($prefix) > 0) ? $prefix . ':feed' : 'feed';
        $feed = $document->createElementNS(XML_Atom_Node::NAMESPACE, $name);
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

    // }}}
    // {{{ protected function _buildNode()

    protected function _buildNode(DOMNode $node)
    {
        parent::_buildNode($node);

        foreach ($this->_entries as $entry) {
            $node->appendChild($entry->_getNode($node));
        }
    }

    // }}}
    // {{{ protected function _createNode()

    protected function _createNode(DOMNode $context_node)
    {
        return $context_node;
    }

    // }}}
}

?>
