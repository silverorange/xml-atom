<?php

/**
 * A abstract class used to model a generic XML node.
 *
 * @package   XML_Atom
 * @copyright 2008-2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @link      https://github.com/silverorange/xml-atom
 */
abstract class XML_Atom_Node
{
    // {{{ class constants

    /**
     * The default namespace for this node.
     *
     * @var string
     */
    const NS = 'http://www.w3.org/2005/Atom';

    // }}}
    // {{{ abstract protected function createNode()

    /**
     * Creates a node
     *
     * @param DOMNode $context_node the parent node that will contain this node.
     *
     * @return XML_Atom_Node
     */
    abstract protected function createNode(DOMNode $context_node);

    // }}}
    // {{{ abstract protected function buildNode()

    /**
     * Builds all the XML information contained inside this node
     *
     * @param DOMNode $node the parent node that will contain the XML generated
     *                      by this node.
     *
     * @return void
     */
    abstract protected function buildNode(DOMNode $node);

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
        $this->buildNode($node);
        return $node;
    }

    // }}}
}

?>
