<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Element class definition.
 */
require_once 'XML/Atom/Element.php';

// {{{ class XML_Atom_Person

/**
 * Abstract base class used to describe a person, corporation or similar entity
 * in some context in an Atom document
 *
 * A person must have a name and may optionally have an associated URI and
 * e-mail address.
 *
 * @category  XML
 * @package   XML_Atom
 * @author    Michael Gauthier <mike@silverorange.com>
 * @copyright 2008-2013 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @link      http://pear.php.net/package/XML_Atom
 */
abstract class XML_Atom_Person extends XML_Atom_Element
{
    // {{{ protected properties

    /**
     * The full name of this person
     *
     * @var string
     */
    protected $_name = '';

    /**
     * The URI of this person
     *
     * This could be the URI for a weblog or a homepage.
     *
     * @var string
     */
    protected $_uri = '';

    /**
     * The e-mail address of this person
     *
     * @var string
     */
    protected $_email = '';

    // }}}
    // {{{ public function __construct()

    /**
     * Creates a new person
     *
     * @param string $name  the full name of this person.
     * @param string $uri   optional. The URI of this person.
     * @param string $email optional. The e-mail address of this person.
     */
    public function __construct($name, $uri = '', $email = '')
    {
        $this->setName($name);
        $this->setUri($uri);
        $this->setEmail($email);
    }

    // }}}
    // {{{ public function setName()

    /**
     * Sets the full name of this person
     *
     * @param string $name the full name of this person.
     *
     * @return void
     */
    public function setName($name)
    {
        $this->_name = strval($name);
    }

    // }}}
    // {{{ public function setUri()

    /**
     * Sets the URI of this person
     *
     * @param string $uri the URI of this person.
     *
     * @return void
     */
    public function setUri($uri)
    {
        $this->_uri = strval($uri);
    }

    // }}}
    // {{{ public function setEmail()

    /**
     * Sets the e-mail address of this person
     *
     * @param string $email the e-mail address of this person.
     *
     * @return void
     */
    public function setEmail($email)
    {
        $this->_email = strval($email);
    }

    // }}}
    // {{{ protected function _buildNode()

    /**
     * Builds and creates the Atom XML nodes required by this person
     *
     * The element node representing this person is created separately and
     * passed as the first parameter of this method.
     *
     * @param DOMNode $node the node representing this person. Extra nodes
     *                      should be created and added to this node.
     *
     * @return void
     */
    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $name_node = $document->createElementNS(XML_Atom_Node::NS,
            'name');

        $name_content = $document->createTextNode($this->_name);
        $name_node->appendChild($name_content);

        $node->appendChild($name_node);

        if ($this->_uri != '') {
            $uri_node = $document->createElementNS(XML_Atom_Node::NS, 'uri');
            $uri_content = $document->createTextNode($this->_uri);
            $uri_node->appendChild($uri_content);

            $node->appendChild($uri_node);
        }

        if ($this->_email != '') {
            $email_node = $document->createElementNS(
                XML_Atom_Node::NS,
                'email'
            );
            $email_content = $document->createTextNode($this->_email);
            $email_node->appendChild($email_content);

            $node->appendChild($email_node);
        }
    }

    // }}}
}

// }}}

?>
