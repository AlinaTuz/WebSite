<?php
$link = getHttpVar('curDir', '/');
$curdir = "." . $link;

if (strpos(substr($curdir, 2), "./") || strpos(substr($curdir, 2), "../")) {
    $curdir = "./";
    $link = "/";
}
?>

<div class="fileManager">
    <script>function turnBack() {
            //alert('<?=(removeLastLinkLevel($link)); ?>');
            window.open("<?= "?page=file&sortBy=" . getHttpVar("sortBy", "Name") . "&curDir=" . removeLastLinkLevel($link); ?> ", "_self")
        };</script>

    Сортувати за:
    <a style="color: black;" id="sortByName" href="index.php?page=file&sortBy=Name&curDir=<?=("$link"); ?>">Ім'ям</a>
    <a style="color: black;" id="sortBySize" href="index.php?page=file&sortBy=Size&curDir=<?=("$link"); ?>"">Розміром</a>
    <a style="color: black;" id="sortByDate" href="index.php?page=file&sortBy=Date&curDir=<?=("$link"); ?>"">Часом створення</a><br><br>
    <?php

    function removeLastLinkLevel($someLink)
    {
        $pos = strrpos(substr($someLink, 0, strlen($someLink) - 1), '/');
        $resLink = substr($someLink, 0, $pos + 1);
        return $resLink;
    }
    function sortName($a, $b)
    {
        if ($a['dir'] && !$b['dir'])
            return -1;
        else if (!$a['dir'] && $b['dir'])
            return 1;
        else
            return strcmp($a['fName'], $b['fName']);
    }


    function sortDate($a, $b)
    {
        return strcmp($a['fDate'], $b['fDate']);
    }

    function sortSize($a, $b)
    {
        return ($a['fSize'] - $b['fSize']);
    }

    function getSizeUnit($size){
        if ($size < 1024)
            return $size."b";
        else if($size<1048576)
            return round($size/1024,2)."Kb";
        else if ($size < 1073741824)
            return round($size / 1048576, 2) . "Mb";
    }

    echo "Current dir: " . $curdir . "<br><br>";
    chdir($curdir);
    echo '<button onclick="turnBack()">←</button>
    Список файлів:<br>';
    $fileList = array();
    $d = opendir(".");
    

    while ($fname = readdir($d)) {
        if ($fname !== '..' && $fname !== '.') {
            $fileList[] = array(
                "fName" => $fname,
                "dir" => is_dir($fname),
                "fSize" => filesize($fname),
                "fDate" => filectime($fname),
            );
        }
    }
    closedir($d);

    $sortBy = getHttpVar("sortBy", "Name");
    echo '<style type="text/css">
        #sortBy' . $sortBy . '{
            text-decoration: underline;
        }
        </style>';

    usort($fileList, "sort" . $sortBy);
    echo '
    <table class = "tableManager"">
    <tr><thead>
        <td>Name</td>
        <td>/DIR?</td>
        <td>Size</td>
        <td>Date</td>
    </thead></tr>';
    foreach ($fileList as $fItem) {
        echo '<tr>
            <td>' . ($fItem['dir'] ? '<a style="color: black;" href="' . "?page=file&sortBy=" 
            . $sortBy . "&curDir=" . $link . $fItem['fName'] . "/" . '">' 
            . $fItem['fName'] . '</a>': $fItem['fName']) . '</td>

            <td>' . ($fItem['dir'] ? 'DIR' : ' ') . '</td>
            <td>' . getSizeUnit($fItem['fSize']) . '</td>
            <td>' . date("d.m.Y H:i", $fItem['fDate']) . '</td>
     </tr>';
    }
    echo '</table>';
	?>
</div>