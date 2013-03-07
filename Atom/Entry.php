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
 * A class used to generate an entry node.
 *
 * @package   XML_Atom
 * @copyright 2008-2013 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Entry extends XML_Atom_Element
{
    // {{{ protected properties

    /**
     * The id for this entry node
     *
     * @var string
     */
    protected $_id = '';

    /**
     * The title for this entry node
     *
     * @var Atom_XML_Title
     */
    protected $_title = null;

    /**
     * The updated date of this entry node
     *
     * @var XML_Atom_Updated
     */
    protected $_updated = null;

    /**
     * The published date of this entry node
     *
     * @var XML_Atom_Published
     */
    protected $_published = null;

    /**
     * The content of this entry node
     *
     * @var XML_Atom_Updated
     */
    protected $_content = null;

    /**
     * The summary of this entry node
     *
     * @var XML_Atom_Updated
     */
    protected $_summary = null;

    /**
     * The rights for this entry node
     *
     * @var string
     */
    protected $_rights = '';

    /**
     * The source of this entry node
     *
     * @var XML_Atom_Source
     */
    protected $_source = null;

    /**
     * The authors for this entry node
     *
     * @var array()
     */
    protected $_authors = array();

    /**
     * The contributors for this entry node
     *
     * @var array()
     */
    protected $_contributors = array();

    /**
     * The categories for this entry node
     *
     * @var array()
     */
    protected $_categories = array();

    /**
     * The links for this entry node
     *
     * @var array()
     */
    protected $_links = array();

    // }}}
    // {{{ public function __construct()

    /**
     * Contructs this XML_Atom_Entry
     *
     * @param string $id      the id of the person to use.
     * @param mixed  $title   the title to use or a XML_Atom_Title object.
     * @param mixed  $updated the updated date to use or a
     *                        {@link XML_Atom_Updated} object.
     */
    public function __construct($id, $title, $updated = null)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setUpdated($updated);
    }

    // }}}
    // {{{ public function setId()

    /**
     * Sets the id of this node.
     *
     * @param string $id the id to set this node to.
     *
     * @return void
     */
    public function setId($id)
    {
        $this->_id = strval($id);
    }

    // }}}
    // {{{ public function setTitle()

    /**
     * Set the title of this entry
     *
     * @param mixed  $title the title to use or a XML_Atom_Updated object.
     * @param string $type  the type to use.
     *
     * @return void
     */
    public function setTitle($title, $type = 'text')
    {
        if (!($title instanceof XML_Atom_Title)) {
            $title = new XML_Atom_Title($title, $type);
        }

        $this->_title = $title;
    }

    // }}}
    // {{{ public function setUpdated()

    /**
     * Set the updated date of this entry
     *
     * @param mixed $updated the updated date to use or a XML_Atom_Updated
     *                       object.
     *
     * @return void
     */
    public function setUpdated($updated)
    {
        if (!($updated instanceof XML_Atom_Updated)) {
            $updated = new XML_Atom_Updated($updated);
        }

        $this->_updated = $updated;
    }

    // }}}
    // {{{ public function setPublished()

    /**
     * Set the published date of this entry
     *
     * @param mixed $published the published date to use or an
     *                         {@link XML_Atom_Published} object.
     *
     * @return void
     */
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

    /**
     * Set the content of this entry
     *
     * @param mixed  $title    the content to use or an
     *                         {@link XML_Atom_Content} object.
     * @param string $type     the type to use.
     * @param string $language the type to use.
     *
     * @return void
     */
    public function setContent($content, $type = 'text', $language = '')
    {
        if (!($content === null || $content instanceof XML_Atom_Content)) {
            $content = new XML_Atom_Content($content, $type, $language);
        }

        $this->_content = $content;
    }

    // }}}
    // {{{ public function setSummary()

    /**
     * Set the summary of this entry
     *
     * @param mixed  $summary  the summary to use or an
     *                         {@link XML_Atom_Summary} object.
     * @param string $type     the type to use.
     * @param string $language the type to use.
     *
     * @return void
     */
    public function setSummary($summary, $type = 'text', $language = '')
    {
        if (!($summary === null || $summary instanceof XML_Atom_Summary)) {
            $summary = new XML_Atom_Summary($summary, $type, $language);
        }

        $this->_summary = $summary;
    }

    // }}}
    // {{{ public function setRights()

    /**
     * Sets the rights of this node.
     *
     * @param string $rights the rights to set this node to.
     *
     * @return void
     */
    public function setRights($rights)
    {
        $this->_rights = strval($rights);
    }

    // }}}
    // {{{ public function setSource()

    /**
     * Set the source of this entry
     *
     * @param mixed $source the source to use in the form of an
     *                      {@link XML_Atom_Feed} object or an
     *                      {@link XML_Atom_Source} object.
     *
     * @return void
     */
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

    /**
     * Adds an author to this entry
     *
     * @param mixed  $name  the name to be added or an
     *                      {@link XML_Atom_Author} object.
     * @param string $uri   the URI to be added.
     * @param string $email the email to be added.
     *
     * @return void
     */
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

    /**
     * Adds a contributor to this entry
     *
     * @param mixed  $name  the name to be added or an
     *                      {@link XML_Atom_Contributor} object.
     * @param string $uri   the URI to be added.
     * @param string $email the email to be added.
     *
     * @return void
     */
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

    /**
     * Adds category to this entry
     *
     * @param mixed  $term     the term used to decribe this category or an
     *                         {@link XML_Atom_Category} object.
     * @param string $scheme   the scheme to be added.
     * @param string $label    the label to be added.
     * @param string $language the language to be added.
     *
     * @return void
     */
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

    /**
     * Adds a link to this entry
     *
     * @param XML_Atom_Link|string $href     the href of the link or an
     *                                       {@link XML_Atom_Link} object.
     * @param string               $rel      optional. The link relationship.
     * @param string               $type     optional. The type of the link.
     * @param string               $hreflang optional. The language of the
     *                                       link.
     *
     * @return void
     */
    public function addLink($href, $rel = '', $type = '', $hreflang = '')
    {
        if ($href instanceof XML_Atom_Link) {
            $link = $href;
        } else {
            $link = new XML_Atom_Link($href, $rel, $type, $hreflang);
        }

        $this->_links[] = $link;
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

        $name = (strlen($prefix) > 0) ? $prefix . ':entry' : 'entry';
        $entry = $document->createElementNS(XML_Atom_Node::NS, $name);
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

    /**
     * Creates an entry node
     *
     * @param DOMNode $context_node the parent node that will contain this
     *                              entry node.
     *
     * @return DOMNode the new entry node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        $namespace = $context_node->namespaceURI;
        $local_name = $context_node->localName;

        if ($namespace == XML_Atom_Node::NS && $local_name == 'feed') {
            $document = $context_node->ownerDocument;
            $node = $document->createElementNS(XML_Atom_Node::NS, 'entry');
        } else {
            $node = $context_node;
        }

        return $node;
    }

    // }}}
    // {{{ protected function _buildNode()

    /**
     * Builds all the XML information contained inside this node.
     *
     * @param DOMNode $node the parent node that will contain the XML
     *                      generated by this node.
     *
     * @return void
     */
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
        $id_node = $document->createElementNS(XML_Atom_Node::NS, 'id');
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
            $rights_node = $document->createElementNS(
                XML_Atom_Node::NS,
                'rights'
            );
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
