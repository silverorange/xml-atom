<?php

require_once 'XML/Atom/Node.php';

/**
 * A abstract class used to model the features of an element.
 *
 * @package   XML_Atom
 * @copyright 2008-2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @link      https://github.com/silverorange/xml-atom
 */
abstract class XML_Atom_Element extends XML_Atom_Node
{
    // {{{ protected properties

    /**
     * The language of this node
     *
     * @var string
     */
    protected $language = '';

    /**
     * The base of this node
     *
     * @var string
     */
    protected $base = '';

    /**
     * An array of namespaces used for this node
     *
     * @var array()
     */
    protected $namespaces = array();

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
        $this->base = strval($base);
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
        $this->language = strval($language);
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
        $this->namespaces[strval($prefix)] = strval($uri);
    }

    // }}}
    // {{{ protected function buildNamespaces()

    /**
     * Builds the XML namespaces into a node.
     *
     * @param DOMNode $node the node to add the XML namespaces to.
     *
     * @return void
     */
    protected function buildNamespaces(DOMNode $node)
    {
        foreach ($this->namespaces as $prefix => $uri) {
            $node->setAttribute('xmlns:'.$prefix, $uri);
        }
    }

    // }}}
    // {{{ protected function buildCommonAttributes()

    /**
     * Builds the language and base common attributes into a node
     *
     * @param DOMNode $node the node to add the common attributes to.
     *
     * @return void
     */
    protected function buildCommonAttributes(DOMNode $node)
    {
        if ($this->base != '') {
            $node->setAttribute('xml:base', $this->base);
        }

        if ($this->language != '') {
            $node->setAttribute('xml:lang', $this->language);
        }
    }

    // }}}
    // {{{ protected function getNode()

    /**
     * Gets a built copy of the current node.
     *
     * @param DOMNode $context_node the parent node to this node.
     *
     * @return DOMNode a built copy of the current node.
     */
    protected function getNode(DOMNode $context_node)
    {
        $node = $this->createNode($context_node);

        $this->buildNamespaces($node);
        $this->buildCommonAttributes($node);
        $this->buildNode($node);
        $this->buildExtensionNodes($node);

        return $node;
    }

    // }}}
    // {{{ protected function buildExtensionNodes()

    /**
     * Builds the extension nodes...
     *
     * @param DOMNode $node
     */
    protected function buildExtensionNodes(DOMNode $node)
    {
    }

    // }}}
}

?>
