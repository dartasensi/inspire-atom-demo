<?php 
$returnFile = false;

$topFeedURL = "GE.atom.top.feed.en.xml";
$datasetFeedURL = "GE.atom.ds.feed.en.xml";

foreach (apache_request_headers() as $name => $value) {
    if ($name=="Accept" && $value=="application/atom+xml") {
        $returnFile = true;
    }
}
// parse URL parameters
$q= $_GET['q'];
$uriCode = $_GET['spatial_dataset_identifier_code'];
$uriNamespace= $_GET['spatial_dataset_identifier_namespace'];
$crs= $_GET['crs'];
$language= $_GET['language'];

if (!$uriCode) {
    if (!$q) {
        header("Location: " + $topFeedURL);
        exit;
    }
    $uriCode = $q;
}

if (!$language || $language == "*"){
    // default language
    $language = "en";
}
if ($language != 'en' && $language != 'it'){
    die( "Only en and it languages are supported" );
}

if (!$uriNamespace || $uriNamespace == ""){
    // default namespace
    $uriNamespace = "http://sgi.isprambiente.it";
}

if ($uriCode == "ispra_rm:Carta_Geologica_Armonizzata_1:100k_DT" &&
    $uriNamespace == "http://sgi.isprambiente.it" &&
    $crs == "http://www.opengis.net/def/crs/EPSG/0/4258") {
    if ($returnFile){
        header("Location: " + datasetFeedURL);
    } else{
        header("Location: " + datasetFeedURL);
    }
    exit;
}
    
echo 'Not found';
?>