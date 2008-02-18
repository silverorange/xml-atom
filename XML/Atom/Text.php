<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'XML/Atom/Element.php';

/**
 * Text
 *
 * @package   XML-Atom
 * @copyright 2008 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 */
abstract class XML_Atom_Text extends XML_Atom_Element
{
    // {{{ protected properties

    protected $_text = '';
    protected $_type = '';

    // }}}
    // {{{ public function __construct()

    public function __construct($text, $type = 'text', $language = '')
    {
        $this->setText($text);
        $this->setType($type);
        $this->setLanguage($language);
    }

    // }}}
    // {{{ public function setText()

    public function setText($text)
    {
        $this->_text = strval($text);
    }

    // }}}
    // {{{ public function setType()

    public function setType($type)
    {
        $this->_type = strval($type);
    }

    // }}}
    // {{{ protected function _buildNode()

    protected function _buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $node->setAttribute($this->_getAtomNodeName($node, 'type'),
            $this->_type);

        $cdata_node = $document->createCDATASection($this->_text);
        $node->appendChild($cdata_node);
    }

    // }}}
}

?>
