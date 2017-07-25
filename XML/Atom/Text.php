<?php

require_once 'XML/Atom/Element.php';

/**
 * An abstract class used to model any node that represents any type of text.
 *
 * @package   XML_Atom
 * @copyright 2008-2017 silverorange
 * @license   http://www.gnu.org/copyleft/lesser.html LGPL License 2.1
 * @link      https://github.com/silverorange/xml-atom
 */
abstract class XML_Atom_Text extends XML_Atom_Element
{
    // {{{ protected properties

    /**
     * The text of this node
     *
     * @var string
     */
    protected $text = '';

    /**
     * The type of this node
     *
     * @var string
     */
    protected $type = '';

    // }}}
    // {{{ public function __construct()

    /**
     * Contructs this XML_Atom_Text
     *
     * @param string $text     the text to use.
     * @param string $type     the type to use.
     * @param string $language the langauge to use.
     */
    public function __construct($text, $type = 'text', $language = '')
    {
        $this->setText($text);
        $this->setType($type);
        $this->setLanguage($language);
    }

    // }}}
    // {{{ public function setText()

    /**
     * Sets the text of this node
     *
     * @param string $text the text this node should use.
     *
     * @return void
     */
    public function setText($text)
    {
        $this->text = strval($text);
    }

    // }}}
    // {{{ public function setType()

    /**
     * Sets the type of this node
     *
     * @param string $type the type this node should use.
     *
     * @return void
     */
    public function setType($type)
    {
        $this->type = strval($type);
    }

    // }}}
    // {{{ protected function buildNode()

    /**
     * Builds and creates the Atom XML nodes required by this text
     *
     * The element node representing this text is created separately and passed
     * as the first parameter of this method.
     *
     * The text content of this text is created as a text node.
     *
     * @param DOMNode $node the node representing this text. Extra nodes should
     *                      be created and added to this node.
     *
     * @return void
     */
    protected function buildNode(DOMNode $node)
    {
        $document = $node->ownerDocument;

        $node->setAttributeNS(XML_Atom_Node::NS, 'type', $this->type);

        $text_node = $document->createTextNode($this->text);
        $node->appendChild($text_node);
    }

    // }}}
}

?>
