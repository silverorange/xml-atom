<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * A abstract class used to model a generic XML node.
 *
 * @package   XML_Atom
 * @copyright 2008-2013 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
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
    // {{{ abstract protected function _createNode()

    /**
     * Creates a node
     *
     * @param DOMNode $context_node the parent node that will contain this node.
     *
     * @return XML_Atom_Node
     */
    abstract protected function _createNode(DOMNode $context_node);

    // }}}
    // {{{ abstract protected function _buildNode()

    /**
     * Builds all the XML information contained inside this node
     *
     * @param DOMNode $node the parent node that will contain the XML generated
     *                      by this node.
     *
     * @return void
     */
    abstract protected function _buildNode(DOMNode $node);

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
        $this->_buildNode($node);
        return $node;
    }

    // }}}
}

?>
