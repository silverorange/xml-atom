<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

/**
 * Category
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
class XML_Atom_Category extends XML_Atom_Element
{
    // {{{ protected properties

    /**
     * The term to describe the category of this node
     *
     * @var string
     */
    protected $_term = '';

    /**
     * The sheme of this node
     *
     * @var string
     */
    protected $_scheme = '';

    /**
     * The label of this node
     *
     * @var string
     */
    protected $_label = '';

    // }}}
    // {{{ public function __construct()

    /**
     * Contruct this XML_Atom_Category
     *
     * @param string $term the term used to decribe this category.
     * @param string $scheme the scheme to use.
     * @param string $label the label to use.
     * @param string $language the language to use.
     */
    public function __construct($term, $scheme = '', $label = '',
        $laguage = '')
    {
        $this->setTerm($term);
        $this->setScheme($scheme);
        $this->setLabel($label, $language);
    }

    // }}}
    // {{{ public function setTerm()

    /**
     * Set the term of this node
     *
     * @param string $term the term used to describe the category.
     */
    public function setTerm($term)
    {
        $this->_term = strval($term);
    }

    // }}}
    // {{{ public function setScheme()

    /**
     * Set the scheme of this node
     *
     * @param mixed $scheme the scheme this node should use.
     */
    public function setScheme($scheme)
    {
        $this->_scheme = strval($scheme);
    }

    // }}}
    // {{{ public function setLabel()

    /**
     * Set the label of this node
     *
     * @param mixed $label the label this node should use.
     * @param mixed $language the language this node should use.
     */
    public function setLabel($label, $language = '')
    {
        $this->_label = strval($label);
        $this->setLanguage($language);
    }

    // }}}
    // {{{ protected function _createNode()

    /**
     * Create a category node
     *
     * @param DOMNode $context_node the parent node that will contain this
     *   category node.
     *
     * @return DOMNode the new category node.
     */
    protected function _createNode(DOMNode $context_node)
    {
        $document = $context_node->ownerDocument;
        return $document->createElementNS(XML_Atom_Node::NAMESPACE, 'category');
    }

    // }}}
    // {{{ protected function _buildNode()

    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $node->setAttributeNS(XML_Atom_Node::NAMESPACE,
            $this->_getAtomNodeName($node, 'term'), $this->_term);

        if ($this->_scheme != '') {
            $node->setAttributeNS(XML_Atom_Node::NAMESPACE,
                $this->_getAtomNodeName($node, 'scheme'), $this->_scheme);
        }

        if ($this->_label != '') {
            $node->setAttributeNS(XML_Atom_Node::NAMESPACE,
                $this->_getAtomNodeName($node, 'label'), $this->_label);
        }
    }
    // }}}
}

?>
