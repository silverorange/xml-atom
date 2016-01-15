<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

require_once 'PEAR/PackageFileManager2.php';
PEAR::setErrorHandling(PEAR_ERROR_DIE);

$release_version = '1.0.0';
$release_state   = 'alpha';
$release_notes   =
    'First release.';

$description =
    "This package provides an object-oriented interface to generate Atom " .
    "feeds. The Atom specification is described at " .
    "http://atomenabled.org/developers/syndication/atom-format-spec.php.\n\n".
    "This package requires PHP 5.2.1.";

$package = new PEAR_PackageFileManager2();

$package->setOptions(array(
    'filelistgenerator' => 'file',
    'simpleoutput'      => true,
    'baseinstalldir'    => '/',
    'packagedirectory'  => './',
    'dir_roles'         => array(
        'tests'         => 'test'
    )
));

$package->setPackage('XML_Atom');
$package->setSummary('Object-Oriented Atom Feed Generator');
$package->setDescription($description);
$package->setChannel('pear.silverorange.com');
$package->setPackageType('php');
$package->setLicense('LGPL', 'http://www.gnu.org/copyleft/lesser.html');

$package->setNotes($release_notes);
$package->setReleaseVersion($release_version);
$package->setReleaseStability($release_state);
$package->setAPIVersion('0.1.0');
$package->setAPIStability('alpha');

$package->addIgnore('package.php');
$package->addIgnore('package-2.0.xml');
$package->addIgnore('*.tgz');

$package->addMaintainer('lead', 'gauthierm', 'Mike Gauthier',
    'mike@silverorange.com');

$package->setPhpDep('5.3.0');
$package->setPearinstallerDep('1.4.0');
$package->generateContents();

if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    $package->writePackageFile();
} else {
    $package->debugPackageFile();
}

?>
