<?php

require_once __DIR__ . '/vendor/autoload.php';

$feed = new XML_Atom_Feed('http://example.com/', 'Example Feed');

$feed->addAuthor('Michael Gauthier', '', 'mike@silverorange.com');
$feed->setGenerator('PEAR::XML_Atom');

$entry = new XML_Atom_Entry(
    'http://example.com/archive/2008/january/test-post', 'Test Post');

$entry->setContent('Hello, World!', 'html');

$feed->addEntry($entry);

$entry = new XML_Atom_Entry(
    'http://example.com/archive/2008/february/atom-test',
    'Lorem Ipsum Dolor');

$entry->setSummary('<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eu tellus ut sapien pharetra hendrerit. Suspendisse sed risus. Donec a sapien eget quam malesuada blandit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin quis elit eget quam convallis dictum. Integer lorem quam, laoreet a, bibendum quis, eleifend at, orci. Ut sed est in sem congue lacinia. Praesent cursus feugiat ante. Cras enim. Duis venenatis rutrum tellus. Aliquam erat volutpat. Vestibulum volutpat orci nec lorem. Nunc elit est, gravida eget, mattis vitae, vestibulum at, quam. Aliquam ultrices lacinia tellus. Sed eu metus.</p>', 'html');
$entry->setContent('<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eu tellus ut sapien pharetra hendrerit. Suspendisse sed risus. Donec a sapien eget quam malesuada blandit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin quis elit eget quam convallis dictum. Integer lorem quam, laoreet a, bibendum quis, eleifend at, orci. Ut sed est in sem congue lacinia. Praesent cursus feugiat ante. Cras enim. Duis venenatis rutrum tellus. Aliquam erat volutpat. Vestibulum volutpat orci nec lorem. Nunc elit est, gravida eget, mattis vitae, vestibulum at, quam. Aliquam ultrices lacinia tellus. Sed eu metus.</p><p>Ut non nisi vitae eros tempus nonummy. Etiam accumsan aliquam erat. Praesent magna pede, rhoncus eu, dictum non, vestibulum in, purus. Sed egestas ultrices sapien. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis suscipit justo a sapien. Mauris gravida, tellus a dignissim congue, nisi magna vehicula lorem, sollicitudin viverra ligula augue et mi. Aliquam auctor. Sed faucibus lacus nec nisl. Nulla arcu lorem, dapibus eu, accumsan eu, pulvinar at, risus. Curabitur imperdiet urna sed erat. Vestibulum id nulla. Donec magna risus, egestas ac, imperdiet malesuada, accumsan in, velit. Etiam elementum, eros in tempor sodales, massa nisl vulputate ligula, id semper lectus justo vel enim. Sed nisi mi, tristique in, molestie vel, fermentum nec, nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Proin lacus erat, tristique nec, tempus sed, consectetuer ut, orci.</p>', 'html');

$feed->addEntry($entry);

$document = $feed->getDocument();

echo formatXmlString($document->saveXML());

// ===========================================================================

function formatXmlString($xml) {

    // add marker linefeeds to aid the pretty-tokeniser (adds a linefeed between all tag-end boundaries)
    $xml = preg_replace('/(>)(<)(\/*)/', "$1\n$2$3", $xml);

    // now indent the tags
    $token      = strtok($xml, "\n");
    $result     = ''; // holds formatted version as it is built
    $pad        = 0; // initial indent
    $matches    = array(); // returns from preg_matches()

    // scan each line and adjust indent based on opening/closing tags
    while ($token !== false) {
        // test for the various tag states

        // 1. open and closing tags on same line - no change
        if (preg_match('/.+<\/\w[^>]*>$/', $token, $matches)) {
            $indent = 0;

        // 2. closing tag - outdent now
        } elseif (preg_match('/^<\/\w/', $token, $matches)) {
            $pad--;

        // 3. opening tag - don't pad this one, only subsequent tags
        } elseif (preg_match('/^<\w[^>]*[^\/]>.*$/', $token, $matches)) {
            $indent = 1;

        // 4. no indentation needed
        } else {
            $indent = 0;
        }

        // pad the line with the required number of leading spaces
        $line    = str_pad($token, strlen($token) + $pad, ' ', STR_PAD_LEFT);
        $result .= $line . "\n"; // add to the cumulative result, with linefeed
        $token   = strtok("\n"); // get the next token
        $pad    += $indent; // update the pad size for subsequent lines
    }

    return $result;
}

?>
