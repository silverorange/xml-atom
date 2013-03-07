<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Node.php';

/**
 * A abstract class used to model the features of an element.
 *
 * @package   XML_Atom
 * @copyright 2008-2013 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class XML_Atom_Element extends XML_Atom_Node
{
    // {{{ protected properties

    /**
     * The language of this node
     *
     * @var string
     */
    protected $_language = '';

    /**
     * The base of this node
     *
     * @var string
     */
    protected $_base = '';

    /**
     * An array of namespaces used for this node
     *
     * @var array()
     */
    protected $_namespaces = array();

    // }}}
    // {{{ public function setBase()

    /**
     * Sets the base of this node.
     *
     * @param string $base the base this node should use.
     *
     * @return void
     */
    public function setBase($base)
    {
        $this->_base = strval($base);
    }

    // }}}
    // {{{ public function setLanguage()

    /**
     * Sets the language of this node.
     *
     * @param string $language the language this node should use.
     *
     * @return void
     */
    public function setLanguage($language)
    {
        $this->_language = strval($language);
    }

    // }}}
    // {{{ public function addNamespace()

    /**
     * Adds a namespace to this node.
     *
     * @param string $prefix the prefix of this namespace.
     * @param string $uri    the URI of this namespace.
     *
     * @return void
     */
    public function addNamespace($prefix, $uri)
    {
        $this->_namespaces[strval($prefix)] = strval($uri);
    }

    // }}}
    // {{{ protected function _buildNamespaces()

    /**
     * Builds the XML namespaces into a node.
     *
     * @param DOMNode $node the node to add the XML namespaces to.
     *
     * @return void
     */
    protected function _buildNamespaces(DOMNode $node)
    {
        foreach ($this->_namespaces as $prefix => $uri) {
            $node->setAttribute('xmlns:'.$prefix, $uri);
        }
    }

    // }}}
    // {{{ protected function _buildCommonAttributes()

    /**
     * Builds the language and base common attributes into a node
     *
     * @param DOMNode $node the node to add the common attributes to.
     *
     * @return void
     */
    protected function _buildCommonAttributes(DOMNode $node)
    {
        if ($this->_base != '') {
            $node->setAttribute('xml:base', $this->_base);
        }

        if ($this->_language != '') {
            $node->setAttribute('xml:lang', $this->_language);
        }
    }

    // }}}
    // {{{ protected function _getNode()

    /**
     * Gets a built copy of the current node.
     *
     * @param DOMNode $context_node the parent node to this node.
     *
     * @return DOMNode a built copy of the current node.
     */
    protected function _getNode(DOMNode $context_node)
    {
        $node = $this->_createNode($context_node);

        $this->_buildNamespaces($node);
        $this->_buildCommonAttributes($node);
        $this->_buildNode($node);
        $this->_buildExtensionNodes($node);

        return $node;
    }

    // }}}
    // {{{ protected function _buildExtensionNodes()

    /**
     * Builds the extension nodes...
     *
     * @param DOMNode $node
     */
    protected function _buildExtensionNodes(DOMNode $node)
    {
    }

    // }}}
}

?>
