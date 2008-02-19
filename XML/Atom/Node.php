<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Node
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class XML_Atom_Node
{
    // {{{ class constants

    const NAMESPACE = 'http://www.w3.org/2005/Atom';

    // }}}
    // {{{ abstract protected function _createNode()

    abstract protected function _createNode(DOMNode $context_node);

    // }}}
    // {{{ abstract protected function _buildNode()

    abstract protected function _buildNode(DOMNode $node);

    // }}}
    // {{{ protected function _getNode()

    protected function _getNode(DOMNode $context_node)
    {
        $node = $this->_createNode($context_node);
        $this->_buildNode($node);
        return $node;
    }

    // }}}
}

?>
