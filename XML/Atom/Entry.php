<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';
require_once 'XML/Atom/Author.php';
require_once 'XML/Atom/Category.php';
require_once 'XML/Atom/Content.php';
require_once 'XML/Atom/Contributor.php';
require_once 'XML/Atom/Feed.php';
require_once 'XML/Atom/Link.php';
require_once 'XML/Atom/Published.php';
require_once 'XML/Atom/Source.php';
require_once 'XML/Atom/Summary.php';
require_once 'XML/Atom/Title.php';
require_once 'XML/Atom/Updated.php';

class XML_Atom_Entry extends XML_Atom_Element
{
    protected $_id = '';
    protected $_title = null;
    protected $_updated = null;
    protected $_published = null;
    protected $_content = null;
    protected $_summary = null;
    protected $_rights = '';
    protected $_source = null;
    protected $_authors = array();
    protected $_contributors = array();
    protected $_categories = array();
    protected $_links = array();

    public function __construct($id, $title, $updated = null)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setUpdated($updated);
    }

    public function setId($id)
    {
        $this->_id = strval($id);
    }

    public function setTitle($title, $type = 'text')
    {
        if (!($title instanceof XML_Atom_Title)) {
            $title = new XML_Atom_Title($title, $type);
        }

        $this->_title = $title;
    }

    public function setUpdated($updated)
    {
        if (!($updated instanceof XML_Atom_Updated)) {
            $updated = new XML_Atom_Updated($updated);
        }

        $this->_updated = $updated;
    }

    public function setPublished($published)
    {
        if (!($published === null ||
            $published instanceof XML_Atom_Published)) {
            $published = new XML_Atom_Published($published);
        }

        $this->_published = $published;
    }

    public function setContent($content, $type = 'text', $language = '')
    {
        if (!($content === null || $content instanceof XML_Atom_Content)) {
            $content = new XML_Atom_Content($content, $type, $language);
        }

        $this->_content = $content;
    }

    public function setSummary($summary, $type = 'text', $language = '')
    {
        if (!($summary === null || $summary instanceof XML_Atom_Summary)) {
            $summary = new XML_Atom_Summary($summary, $type, $language);
        }

        $this->_summary = $summary;
    }

    public function setRights($rights)
    {
        $this->_rights = strval($rights);
    }

    public function setSource($source)
    {
        if ($source instanceof XML_Atom_Feed) {
            $source = $source->toSource();
        } elseif (!($source === null || $source instanceof XML_Atom_Source)) {
            throw new Exception('Source must be an XML_Atom_Source or null.');
        }

        $this->_source = $source;
    }

    public function addAuthor($name, $uri = '', $email = '')
    {
        if ($name instanceof XML_Atom_Author) {
            $author = $name;
        } else {
            $author = new XML_Atom_Author($name, $uri, $email);
        }

        $this->_authors[] = $author;
    }

    public function addContributor($name, $uri = '', $email = '')
    {
        if ($name instanceof XML_Atom_Contributor) {
            $contributor = $name;
        } else {
            $contributor = new XML_Atom_Contributor($name, $uri, $email);
        }

        $this->_contributors[] = $contributor;
    }

    public function addCategory($term, $scheme = '', $label = '',
        $language = '')
    {
        if ($term instanceof XML_Atom_Category) {
            $category = $term;
        } else {
            $category = new XML_Atom_Category($term, $scheme, $label,
                $language);
        }

        $this->_categories[] = $category;
    }

    public function addLink(XML_Atom_Link $link)
    {
        $this->_links[] = $link;
    }

    public function getDocument($encoding = 'utf-8')
    {
        $implementation = new DOMImplementation();
        $document = $implementation->createDocument(
            XML_Atom_Node::NAMESPACE, 'entry');

        $document->encoding = $encoding;

        $document_element = $this->_getNode($document);

        return $document;
    }

    public function __toString()
    {
        $document = $this->getDocument();
        return $document->saveXML();
    }

    protected function _createNode(DOMDocument $document)
    {
        if ($document->documentElement->nodeName == 'feed') {
            $node = $document->createElement('entry');
        } else {
            $node = $document->documentElement;
        }

        return $node;
    }

    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        foreach ($this->_authors as $author) {
            $node->appendChild($author->_getNode($document));
        }

        foreach ($this->_categories as $category) {
            $node->appendChild($category->_getNode($document));
        }

        if ($this->_content instanceof XML_Atom_Content) {
            $node->appendChild($this->_content->_getNode($document));
        }

        foreach ($this->_contributors as $contributor) {
            $node->appendChild($contributor->_getNode($document));
        }

        $id_text_node = $document->createTextNode($this->_id);
        $id_node = $document->createElement('id');
        $id_node->appendChild($id_text_node);
        $node->appendChild($id_node);

        foreach ($this->_links as $link) {
            $node->appendChild($link->_getNode($document));
        }

        if ($this->_published instanceof XML_Atom_Published) {
            $node->appendChild($this->_published->_getNode($document));
        }

        if ($this->_rights != '') {
            $rights_text_node = $document->createTextNode($this->_rights);
            $rights_node = $document->createElement('rights');
            $rights_node->appendChild($rights_text_node);
            $node->appendChild($rights_node);
        }

        if ($this->_source instanceof XML_Atom_Source) {
            $node->appendChild($this->_source->_getNode($document));
        }

        if ($this->_summary instanceof XML_Atom_Summary) {
            $node->appendChild($this->_summary->_getNode($document));
        }

        $node->appendChild($this->_title->_getNode($document));
        $node->appendChild($this->_updated->_getNode($document));
    }
}

?>
