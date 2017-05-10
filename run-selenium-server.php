<?php

if (!defined('STDIN')) define('STDIN', fopen('php://stdin', 'r'));

$thisPath = dirname(__FILE__);
$externals = $thisPath . '/externals/';
$seleniumURL = 'https://selenium-release.storage.googleapis.com/3.0/selenium-server-standalone-3.0.1.jar';
$chromeDriverURL = 'https://chromedriver.storage.googleapis.com/2.26/chromedriver_mac64.zip';
$geckoURL = 'https://github.com/mozilla/geckodriver/releases/download/v0.11.1/geckodriver-v0.11.1-macos.tar.gz';


if (!file_exists($externals))
    mkdir($externals, 0755, true);


$seleniumBase = basename($seleniumURL);
getArchive($seleniumBase, $seleniumURL);


$chromeDriverBase = basename($chromeDriverURL);
getArchive($chromeDriverBase, $chromeDriverURL);
echo "**********  Unzip $chromeDriverBase...  **********\n";
$zip = new ZipArchive;
$zip->open($externals . $chromeDriverBase);
$zip->extractTo($externals);
chmod($externals . 'chromedriver', 0755);
$zip->close();


$geckoBase = basename($geckoURL);
getArchive($geckoBase, $geckoURL);
echo "**********  Explode $geckoBase...  **********\n";
$tgz = new PharData($externals . $geckoBase);
$tgz->extractTo($externals, null, true);
chmod($externals . 'geckodriver', 0755);


$options = "-Dwebdriver.gecko.driver={$externals}geckodriver "
    ."-Dwebdriver.chrome.driver={$externals}chromedriver";

echo "**********  Starting Se with $options...  **********\n";
system("java -jar $options  {$externals}{$seleniumBase}");


function getArchive($archive, $URL)
{
    global $externals;
    if (!file_exists($externals . $archive)) {
        echo "**********  Downloading $archive...  **********\n";
        file_put_contents($externals . $archive, fopen($URL, 'r'));
    }
}