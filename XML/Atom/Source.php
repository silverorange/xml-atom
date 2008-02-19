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
require_once 'Date.php';

/**
 * Source
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Source extends XML_Atom_Element
{
    // {{{ protected properties

    protected $_id = '';
    protected $_title = null;
    protected $_updated = null;
    protected $_subtitle = null;
    protected $_icon = '';
    protected $_logo = '';
    protected $_rights = '';
    protected $_generator = null;
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
    // {{{ public function setID()

    /**
     * Set the id of this source
     *
     * @param mixed $id the id to set this source to.
     */
    public function setId($id)
    {
        $this->_id = strval($id);
    }

    // }}}
    // {{{ public function setTitle()

    /**
     * Set the title of this source
     *
     * @param mixed $title the title to set or a XML_Atom_Title object.
     * @param string $type the type used to describe this title.
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
     * Set the updated of this source
     *
     * @param mixed $updated the date this was last updated or a
     *   XML_Atom_Updated object.
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
     * Set the subtitle of this source
     *
     * @param mixed $subtitle the subtitle of this source or a XML_Atom_Subtitle
     *   object.
     * @param string $type the type that describes this subtitle.
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
     * Set the icon of this source
     *
     * @param mixed $icon the icon to set for this source.
     */
    public function setIcon($icon)
    {
        $this->_icon = strval($icon);
    }

    // }}}
    // {{{ public function setLogo()

    /**
     * Set the logo of this source
     *
     * @param mixed $logo the logo to set for this source.
     */
    public function setLogo($logo)
    {
        $this->_logo = strval($logo);
    }

    // }}}
    // {{{ public function setRights()

    /**
     * Set the rights of this source
     *
     * @param mixed $rights the rights to set for this source.
     */
    public function setRights($rights)
    {
        $this->_rights = strval($rights);
    }

    // }}}
    // {{{ public function setGenerator()

    /**
     * Set the generator of this source
     *
     * @param mixed $generator the subtitle of this source or a 
     *   XML_Atom_Generator object.
     * @param string $uri the uri of this generator.
     * @param string $version the version of this generator.
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
     * Add an author to the source 
     *
     * @param mixed $name the name or the author of the XML_Atom_Author object
     * @param string $uri the uri of the author
     * @param string $email the email of the author
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
     * Add a contributor to the source 
     *
     * @param mixed $name the name of the contributor or the
     *   XML_Atom_Contributor object
     * @param string $uri the uri of the contributor
     * @param string $email the email of the contributor
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
     * Add a category to the source 
     *
     * @param mixed $term the term of the category or the XML_Atom_Category
     *   object
     * @param string $sheme the scheme of the category
     * @param string $label the label of the category
     * @param string $language the language of the category
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
     * Add a link to the source 
     *
     * @param XML_Atom_Link $link the link to add to the source
     */
    public function addLink(XML_Atom_Link $link)
    {
        $this->_links[] = $link;
    }

    // }}}
    // {{{ protected function _createNode()

    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NAMESPACE, 'source');
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

        foreach ($this->_contributors as $contributor) {
            $node->appendChild($contributor->_getNode($node));
        }

        if ($this->_generator instanceof XML_Atom_Generator) {
            $node->appendChild($this->_generator->_getNode($node));
        }

        if ($this->_icon != '') {
            $icon_text_node = $document->createTextNode($this->_icon);
            $icon_node = $document->createElementNS(XML_Atom_Node::NAMESPACE,
                'icon');

            $icon_node->appendChild($icon_text_node);
            $node->appendChild($icon_node);
        }

        $id_text_node = $document->createTextNode($this->_id);
        $id_node = $document->createElementNS(XML_Atom_Node::NAMESPACE, 'id');
        $id_node->appendChild($id_text_node);
        $node->appendChild($id_node);

        foreach ($this->_links as $link) {
            $node->appendChild($link->_getNode($node));
        }

        if ($this->_logo != '') {
            $logo_text_node = $document->createTextNode($this->_logo);
            $logo_node = $document->createElementNS(XML_Atom_Node::NAMESPACE,
                'logo');

            $logo_node->appendChild($logo_text_node);
            $node->appendChild($logo_node);
        }

        if ($this->_rights != '') {
            $rights_text_node = $document->createTextNode($this->_rights);
            $rights_node = $document->createElementNS(XML_Atom_Node::NAMESPACE,
                'rights');

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
