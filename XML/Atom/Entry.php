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

/**
 * Entry
 *
 * @package   XML_Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Entry extends XML_Atom_Element
{
    // {{{ protected properties

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

    // }}}
    // {{{ public function __construct()

    public function __construct($id, $title, $updated = null)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setUpdated($updated);
    }

    // }}}
    // {{{ public function setId()

    public function setId($id)
    {
        $this->_id = strval($id);
    }

    // }}}
    // {{{ public function setTitle()

    public function setTitle($title, $type = 'text')
    {
        if (!($title instanceof XML_Atom_Title)) {
            $title = new XML_Atom_Title($title, $type);
        }

        $this->_title = $title;
    }

    // }}}
    // {{{ public function setUpdated()

    public function setUpdated($updated)
    {
        if (!($updated instanceof XML_Atom_Updated)) {
            $updated = new XML_Atom_Updated($updated);
        }

        $this->_updated = $updated;
    }

    // }}}
    // {{{ public function setPublished()

    public function setPublished($published)
    {
        if (!($published === null ||
            $published instanceof XML_Atom_Published)) {
            $published = new XML_Atom_Published($published);
        }

        $this->_published = $published;
    }

    // }}}
    // {{{ public function setContent()

    public function setContent($content, $type = 'text', $language = '')
    {
        if (!($content === null || $content instanceof XML_Atom_Content)) {
            $content = new XML_Atom_Content($content, $type, $language);
        }

        $this->_content = $content;
    }

    // }}}
    // {{{ public function setSummary()

    public function setSummary($summary, $type = 'text', $language = '')
    {
        if (!($summary === null || $summary instanceof XML_Atom_Summary)) {
            $summary = new XML_Atom_Summary($summary, $type, $language);
        }

        $this->_summary = $summary;
    }

    // }}}
    // {{{ public function setRights()

    public function setRights($rights)
    {
        $this->_rights = strval($rights);
    }

    // }}}
    // {{{ public function setSource()

    public function setSource($source)
    {
        if ($source instanceof XML_Atom_Feed) {
            $source = $source->toSource();
        } elseif (!($source === null || $source instanceof XML_Atom_Source)) {
            throw new Exception('Source must be an XML_Atom_Source or null.');
        }

        $this->_source = $source;
    }

    // }}}
    // {{{ public function addAuthor()

    public function addAuthor($name, $uri = '', $email = '')
    {
        if ($name instanceof XML_Atom_Author) {
            $author = $name;
        } else {
            $author = new XML_Atom_Author($name, $uri, $email);
        }

        $this->_authors[] = $author;
    }

    // }}}
    // {{{ public function addContributor()

    public function addContributor($name, $uri = '', $email = '')
    {
        if ($name instanceof XML_Atom_Contributor) {
            $contributor = $name;
        } else {
            $contributor = new XML_Atom_Contributor($name, $uri, $email);
        }

        $this->_contributors[] = $contributor;
    }

    // }}}
    // {{{ public function addCategory()

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

    // }}}
    // {{{ public function addLink()

    public function addLink(XML_Atom_Link $link)
    {
        $this->_links[] = $link;
    }

    // }}}
    // {{{ public function getDocument()

    public function getDocument($encoding = 'utf-8', $prefix = '')
    {
        $document = new DOMDocument('1.0', $encoding);

        $name = (strlen($prefix) > 0) ? $prefix . ':entry' : 'entry';
        $entry = $document->createElementNS(XML_Atom_Node::NAMESPACE, $name);
        $document->appendChild($entry);

        $this->_getNode($entry);

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
    // {{{ protected function _createNode()

    protected function _createNode(DOMNode $context_node)
    {
        $namespace = $context_node->namespaceURI;
        $local_name = $context_node->localName;

        if ($namespace == XML_Atom_Node::NAMESPACE && $local_name == 'feed') {
            $document = $context_node->ownerDocument;
            $node = $document->createElementNS(XML_Atom_Node::NAMESPACE,
                'entry');
        } else {
            $node = $context_node;
        }

        return $node;
    }

    // }}}
    // {{{ protected function _buildNode()

    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        foreach ($this->_authors as $author) {
            $node->appendChild($author->_getNode($node));
        }

        foreach ($this->_categories as $category) {
            $node->appendChild($category->_getNode($node));
        }

        if ($this->_content instanceof XML_Atom_Content) {
            $node->appendChild($this->_content->_getNode($node));
        }

        foreach ($this->_contributors as $contributor) {
            $node->appendChild($contributor->_getNode($node));
        }

        $id_text_node = $document->createTextNode($this->_id);
        $id_node = $document->createElementNS(XML_Atom_Node::NAMESPACE, 'id');
        $id_node->appendChild($id_text_node);
        $node->appendChild($id_node);

        foreach ($this->_links as $link) {
            $node->appendChild($link->_getNode($node));
        }

        if ($this->_published instanceof XML_Atom_Published) {
            $node->appendChild($this->_published->_getNode($node));
        }

        if ($this->_rights != '') {
            $rights_text_node = $document->createTextNode($this->_rights);
            $rights_node = $document->createElementNS(XML_Atom_Node::NAMESPACE,
                'rights');

            $rights_node->appendChild($rights_text_node);
            $node->appendChild($rights_node);
        }

        if ($this->_source instanceof XML_Atom_Source) {
            $node->appendChild($this->_source->_getNode($node));
        }

        if ($this->_summary instanceof XML_Atom_Summary) {
            $node->appendChild($this->_summary->_getNode($node));
        }

        $node->appendChild($this->_title->_getNode($node));
        $node->appendChild($this->_updated->_getNode($node));
    }

    // }}}
}

?>
