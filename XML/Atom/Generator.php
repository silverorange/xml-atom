<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

/**
 * Generator
 *
 * @package   XML_Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Generator extends XML_Atom_Element
{
    // {{{ protected properties

    /**
     * The genetator of this node
     *
     * @var string
     */
    protected $_generator = '';

    /**
     * The URI of this node
     *
     * @var string
     */
    protected $_uri = '';

    /**
     * The version of this node
     *
     * @var string
     */
    protected $_version = '';

    // }}}
    // {{{ public function __construct()

    /**
     * Contruct this XML_Atom_Generator
     *
     * @param string $generator the generator to use.
     * @param string $uri the URI to use.
     * @param string $version the version to use.
     */
    public function __construct($generator, $uri = '', $version = '')
    {
        $this->setGenerator($generator);
        $this->setUri($uri);
        $this->setVersion($version);
    }

    // }}}
    // {{{ public function setGenerator()

    /**
     * Set the generator of this node.
     *
     * @param string $generator the generator to set this node to.
     */
    public function setGenerator($generator)
    {
        $this->_generator = strval($generator);
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
    // {{{ public function setVersion()

    /**
     * Set the version of this node.
     *
     * @param string $version the version to set this node to.
     */
    public function setVersion($version)
    {
        $this->_version = strval($version);
    }

    // }}}
    // {{{ protected function _createNode()

    /**
     * Create a generator node
     *
     * @param DOMNode $context_node the parent node that will contain this
     *   generator node.
     *
     * @return DOMNode the new generator node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NAMESPACE,
            'generator');
    }

    // }}}
    // {{{ protected function _buildNode()

    /**
     * Build all the XML information contained inside a generator node.
     *
     * @param DOMNode $node the node that will contain the XML genereated
     *   by this generator node.
     */
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
