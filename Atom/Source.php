<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';
require_once 'XML/Atom/Author.php';
require_once 'XML/Atom/Category.php';
require_once 'XML/Atom/Contributor.php';
require_once 'XML/Atom/Generator.php';
require_once 'XML/Atom/Link.php';
require_once 'XML/Atom/Subtitle.php';
require_once 'XML/Atom/Title.php';
require_once 'XML/Atom/Updated.php';

/**
 * A class used to generate the source for an Atom Feed.
 *
 * @package   XML_Atom
 * @copyright 2008-2013 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Source extends XML_Atom_Element
{
    // {{{ protected properties

    /**
     * The id for this source node
     *
     * @var string
     */
    protected $_id = '';

    /**
     * The title for this source node
     *
     * @var Atom_XML_Title
     */
    protected $_title = null;

    /**
     * The updated date of this source node
     *
     * @var XML_Atom_Updated
     */
    protected $_updated = null;

    /**
     * The subtitle for this source node
     *
     * @var XML_Atom_Subtitle
     */
    protected $_subtitle = null;

    /**
     * The icon for this source node
     *
     * @var string
     */
    protected $_icon = '';

    /**
     * The logo for this source node
     *
     * @var string
     */
    protected $_logo = '';

    /**
     * The rights for this source node
     *
     * @var string
     */
    protected $_rights = '';

    /**
     * The generator for this source node
     *
     * @var XML_Atom_Generator
     */
    protected $_generator = null;

    /**
     * The authors for this feed.
     *
     * @var array()
     */
    protected $_authors = array();

    /**
     * The contributors for this feed.
     *
     * @var array()
     */
    protected $_contributors = array();

    /**
     * The categories for this feed.
     *
     * @var array()
     */
    protected $_categories = array();

    /**
     * The links for this feed.
     *
     * @var array()
     */
    protected $_links = array();

    // }}}
    // {{{ public function __construct()

    /**
     * Contructs this XML_Atom_Source
     *
     * @param string $id      the id of the person to use.
     * @param mixed  $title   the title to use or a XML_Atom_Title object.
     * @param mixed  $updated the updated date to use or a XML_Atom_Updated
     *                        object.
     */
    public function __construct($id, $title, $updated = null)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setUpdated($updated);
    }

    // }}}
    // {{{ public function setID()

    /**
     * Sets the id of this source node
     *
     * @param mixed $id the id to set this source to.
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
     * Sets the title of this source node
     *
     * @param mixed  $title the title to set or an {@link XML_Atom_Title}
     *                      object.
     * @param string $type  the type used to describe this title.
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
     * Sets the updated of this source node
     *
     * @param mixed $updated the date this was last updated or an
     *                       {@link XML_Atom_Updated} object.
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
    // {{{ public function setSubtitle()

    /**
     * Sets the subtitle of this source node
     *
     * @param mixed  $subtitle the subtitle of this source or an
     *                         {@link XML_Atom_Subtitle} object.
     * @param string $type     the type that describes this subtitle.
     *
     * @return void
     */
    public function setSubtitle($subtitle, $type = 'text')
    {
        if (!($subtitle === null || $subtitle instanceof XML_Atom_Subtitle)) {
            $subtitle = new XML_Atom_Subtitle($subtitle, $type);
        }

        $this->_subtitle = $subtitle;
    }

    // }}}
    // {{{ public function setIcon()

    /**
     * Sets the icon of this source node
     *
     * @param mixed $icon the icon to set for this source.
     *
     * @return void
     */
    public function setIcon($icon)
    {
        $this->_icon = strval($icon);
    }

    // }}}
    // {{{ public function setLogo()

    /**
     * Sets the logo of this source node
     *
     * @param mixed $logo the logo to set for this source.
     *
     * @return void
     */
    public function setLogo($logo)
    {
        $this->_logo = strval($logo);
    }

    // }}}
    // {{{ public function setRights()

    /**
     * Sets the rights of this source node
     *
     * @param mixed $rights the rights to set for this source.
     *
     * @return void
     */
    public function setRights($rights)
    {
        $this->_rights = strval($rights);
    }

    // }}}
    // {{{ public function setGenerator()

    /**
     * Sets the generator of this source node
     *
     * @param mixed  $generator the subtitle of this source or an
     *                          {@link XML_Atom_Generator} object.
     * @param string $uri       the uri of this generator.
     * @param string $version   the version of this generator.
     *
     * @return void
     */
    public function setGenerator($generator, $uri = '', $version = '')
    {
        if (!($generator === null ||
            $generator instanceof XML_Atom_Generator)) {
            $generator = new XML_Atom_Generator($generator, $uri, $version);
        }

        $this->_generator = $generator;
    }

    // }}}
    // {{{ public function addAuthor()

    /**
     * Adds an author to the source node
     *
     * @param mixed  $name  the name or the author or an
     *                      {@link XML_Atom_Author} object.
     * @param string $uri   the uri of the author.
     * @param string $email the email of the author.
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
     * Adds a contributor to this source node
     *
     * @param mixed  $name  the name of the contributor or an
     *                      {@link XML_Atom_Contributor object.
     * @param string $uri   the uri of the contributor.
     * @param string $email the email of the contributor.
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
     * Adds a category to this source node
     *
     * @param mixed  $term     the term of the category or an
     *                         {@link XML_Atom_Category} object.
     * @param string $sheme    the scheme of the category.
     * @param string $label    the label of the category.
     * @param string $language the language of the category.
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
     * @param string               $hreflang optional. The language of the link.
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
    // {{{ protected function _createNode()

    /**
     * Creates a source node
     *
     * @param DOMNode $context_node the parent node that will contain this
     *                              source node.
     *
     * @return DOMNode the new source node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NS, 'source');
    }

    // }}}
    // {{{ protected function _buildNode()

    /**
     * Builds all the XML information contained inside this node.
     *
     * @param DOMNode $node the parent node that will contain the XML generated
     *                      by this node.
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

        foreach ($this->_contributors as $contributor) {
            $node->appendChild($contributor->_getNode($node));
        }

        if ($this->_generator instanceof XML_Atom_Generator) {
            $node->appendChild($this->_generator->_getNode($node));
        }

        if ($this->_icon != '') {
            $icon_text_node = $document->createTextNode($this->_icon);
            $icon_node = $document->createElementNS(XML_Atom_Node::NS, 'icon');
            $icon_node->appendChild($icon_text_node);
            $node->appendChild($icon_node);
        }

        $id_text_node = $document->createTextNode($this->_id);
        $id_node = $document->createElementNS(XML_Atom_Node::NS, 'id');
        $id_node->appendChild($id_text_node);
        $node->appendChild($id_node);

        foreach ($this->_links as $link) {
            $node->appendChild($link->_getNode($node));
        }

        if ($this->_logo != '') {
            $logo_text_node = $document->createTextNode($this->_logo);
            $logo_node = $document->createElementNS(XML_Atom_Node::NS, 'logo');
            $logo_node->appendChild($logo_text_node);
            $node->appendChild($logo_node);
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

        if ($this->_subtitle instanceof XML_Atom_Subtitle) {
            $node->appendChild($this->_subtitle->_getNode($node));
        }

        $node->appendChild($this->_title->_getNode($node));
        $node->appendChild($this->_updated->_getNode($node));
    }

    // }}}
}

?>
