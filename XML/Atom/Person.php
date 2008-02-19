<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

/**
 * An abstract class used to build XML repsenting a person node in an Atom Feed.
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class XML_Atom_Person extends XML_Atom_Element
{
    // {{{ protected properties

    /**
     * The name of this person
     *
     * @var string
     */
    protected $_name = '';

    /**
     * The URI of this person
     *
     * @var string
     */
    protected $_uri = '';

    /**
     * The email of this person
     *
     * @var string
     */
    protected $_email = '';

    // }}}
    // {{{ public function __construct()

    /**
     * Contruct this XML_Atom_Person
     *
     * @param string $name the name of the person to use.
     * @param string $uri the URI of the person to use.
     * @param string $email the email of the person to use.
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
     * Set the name of this node.
     *
     * @param string $name the name to set this node to.
     */
    public function setName($name)
    {
        $this->_name = strval($name);
    }

    // }}}
    // {{{ public function setUri()

    /**
     * Set the URI of this node.
     *
     * @param string $uri the URI to set this node to.
     */
    public function setUri($uri)
    {
        $this->_uri = strval($uri);
    }

    // }}}
    // {{{ public function setEmail()

    /**
     * Set the email for this node.
     *
     * @param string $email the email to set this node to.
     */
    public function setEmail($email)
    {
        $this->_email = strval($email);
    }

    // }}}
    // {{{ protected function _buildNode()

    /**
     * Build all the XML information contained inside a person node.
     *
     * @param DOMNode $node the person node that will contain the XML genereated
     *   by this node.
     */
    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $name_node = $document->createElementNS(XML_Atom_Node::NAMESPACE,
            'name');

        $name_content = $document->createTextNode($this->_name);
        $name_node->appendChild($name_content);

        $node->appendChild($name_node);

        if ($this->_uri != '') {
            $uri_node = $document->createElementNS(XML_Atom_Node::NAMESPACE,
                'uri');

            $uri_content = $document->createTextNode($this->_uri);
            $uri_node->appendChild($uri_content);

            $node->appendChild($uri_node);
        }

        if ($this->_email != '') {
            $email_node = $document->createElementNS(XML_Atom_Node::NAMESPACE,
                'email');

            $email_content = $document->createTextNode($this->_email);
            $email_node->appendChild($email_content);

            $node->appendChild($email_node);
        }
    }

    // }}}
}

?>
