<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

/**
 * Person
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class XML_Atom_Person extends XML_Atom_Element
{
    // {{{ protected properties

    protected $_name = '';
    protected $_uri = '';
    protected $_email = '';

    // }}}
    // {{{ public function __construct()

    public function __construct($name, $uri = '', $email = '')
    {
        $this->setName($name);
        $this->setUri($uri);
        $this->setEmail($email);
    }

    // }}}
    // {{{ public function setName()

    public function setName($name)
    {
        $this->_name = strval($name);
    }

    // }}}
    // {{{ public function setUri()

    public function setUri($uri)
    {
        $this->_uri = strval($uri);
    }

    // }}}
    // {{{ public function setEmail()

    public function setEmail($email)
    {
        $this->_email = strval($email);
    }

    // }}}
    // {{{ protected function _buildNode()

    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $name_node = $document->createElement(
            $this->_getAtomNodeName($node, 'name'));

        $name_content = $document->createTextNode($this->_name);
        $name_node->appendChild($name_content);

        $node->appendChild($name_node);

        if ($this->_uri != '') {
            $uri_node = $document->createElement(
                $this->_getAtomNodeName($node, 'uri'));

            $uri_content = $document->createTextNode($this->_uri);
            $uri_node->appendChild($uri_content);

            $node->appendChild($uri_node);
        }

        if ($this->_email != '') {
            $email_node = $document->createElement(
                $this->_getAtomNodeName($node, 'email'));

            $email_content = $document->createTextNode($this->_email);
            $email_node->appendChild($email_content);

            $node->appendChild($email_node);
        }
    }

    // }}}
}

?>
