<?php
$P_TITTLE = "Shop";
$page_view = "shop";
$xml_file = "xml/product.xml";
$tmpTypes = null;
$tmpColor = null;
$tmpProducts = null;

$curtag = "";
function startElement($p, $elname, $attr)
{
    global $curtag,$level, $tmpTypes, $tmpProviders, $tmpProducts;
    $level++;
    $curtag = $elname;

    switch ($elname) {
        case "COLOR":
            $tmpColor = Array();
            $tmpColor['color'] = $attr['COLOR'];
            break;
        case "TYPE":
            $tmpTypes = Array();
            $tmpTypes['myType'] = $attr['MTYPE'];
            break;
        case "PRODUCT":
            $tmpProducts = Array();
            $tmpProducts['bySale'] = $attr['BYSALE'];
            $tmpProducts['sellType'] = $attr['SELLTYPE'];
            break;
        case "DEVCOLOR":
            $tmpProducts['deviceColor'] = $attr['DEVICECOLOR'];
            break;
    }
}

function endElement($p, $elname)
{
    global $level, $products,$selltypes, $color,$tmpTypes, $tmpColor, $tmpProducts;

    switch($elname){
        case "COLOR":
            $color[] = $tmpColor;
        break;
        case "TYPE":
            $selltypes[] = $tmpTypes;
        break;
        case "PRODUCT":
            $products[] = $tmpProducts;
        break;
        }
    $level--;
}

function dataHandler($p,$dat){
    global $curtag, $level,$tmpTypes, $tmpColor, $tmpProducts;
    
    if(trim($dat)!="")
    switch($curtag){
    case "COLOR":
        $tmpColor['name'] = $dat;
    break;
    case "TYPE":
        $tmpTypes['name'] = $dat;
    break;
        case "NAME":
        $tmpProducts['name'] = $dat;
        break;
    case "PRICE":
        $tmpProducts['price'] = $dat;
        break;
    case "SERIALNUM":
        $tmpProducts['serialNum'] = $dat;
        break;
    case "RELEASEYEAR":
        $tmpProducts['releaseYear'] = $dat;
    break;
    case "AVQUANTITY":
        $tmpProducts['avQuantity'] = $dat;
    break;
    case "FORM":
        $tmpProducts['form'] = $dat;
    break;
    case "IMGLINK":
        $tmpProducts['imgLink'] = $dat;
    break;
}
}

$level = 0;

$color = Array();
$selltypes = Array();
$products = Array();

$p = xml_parser_create("UTF-8");
xml_parser_set_option($p, XML_OPTION_CASE_FOLDING, true);

xml_set_element_handler($p, "startElement", "endElement");
xml_set_character_data_handler($p, "dataHandler");

if (!($fp = fopen($xml_file, "r"))) {
    echo "File open Error";
    exit();
}

while ($d = fread($fp, 4096)) {
    if (!xml_parse($p, $d, feof($fp)))
        echo "Error XML parsing <br>"; 
}
xml_parser_free($p);