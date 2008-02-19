<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

/**
 * Generator
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Generator extends XML_Atom_Element
{
    // {{{ protected properties

    protected $_generator = '';
    protected $_uri = '';
    protected $_version = '';

    // }}}
    // {{{ public function __construct()

    public function __construct($generator, $uri = '', $version = '')
    {
        $this->setGenerator($generator);
        $this->setUri($uri);
        $this->setVersion($version);
    }

    // }}}
    // {{{ public function setGenerator()

    public function setGenerator($generator)
    {
        $this->_generator = strval($generator);
    }

    // }}}
    // {{{ public function setUri()

    public function setUri($uri)
    {
        $this->_uri = strval($uri);
    }

    // }}}
    // {{{ public function setVersion()

    public function setVersion($version)
    {
        $this->_version = strval($version);
    }

    // }}}
    // {{{ protected function _createNode()

    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NAMESPACE,
            'generator');
    }

    // }}}
    // {{{ protected function _buildNode()

    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        if ($this->_uri != '') {
            $node->setAttributeNS(XML_Atom_Node::NAMESPACE, 'uri', $this->_uri);
        }

        if ($this->_version != '') {
            $node->setAttributeNS(XML_Atom_Node::NAMESPACE, 'version',
                $this->_version);
        }

        $generator_content = $document->createTextNode($this->_generator);
        $node->appendChild($generator_content);
    }

    // }}}
}

?>
