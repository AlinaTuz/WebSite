<?php
$link = getHttpVar('curDir', '/');
$curdir = "." . $link;
if(isset($_POST['save']))
{
	$file_to_search = $_POST['name'];
	search_file('.',$file_to_search);
}

if (strpos(substr($curdir, 2), "./") || strpos(substr($curdir, 2), "../")) {
    $curdir = "./";
    $link = "/";
}
?>

<div>
    <script>function turnBack() {
            //alert('<?=(removeLastLinkLevel($link)); ?>');
            window.open("<?= "?page=file&sortBy=" . getHttpVar("sortBy", "Name") . "&curDir=" . removeLastLinkLevel($link); ?> ", "_self")
        };</script>

    Поиск:
	<form action="" method="POST">
	<input type="hidden" name="action" value="procfrm">
    	<span style="display: block"><label>Имя файла:</label><input type="text" id="name" name="name"></span>
	<p><input type="submit" name="save" value="enter"></p><br><br>
	</form>
    <?php

    function removeLastLinkLevel($someLink)
    {
        $pos = strrpos(substr($someLink, 0, strlen($someLink) - 1), '/');
        $resLink = substr($someLink, 0, $pos + 1);
        return $resLink;
    }

	function search_file($dir,$file_to_search){

	$files = scandir($dir);

	foreach($files as $key => $value){

		$path = realpath($dir.DIRECTORY_SEPARATOR.$value);

		if(!is_dir($path)) {

			if($file_to_search == $value){
				echo "file found<br>";
				echo $path;
				break;
			}

		} else if($value != "." && $value != "..") {

			search_file($path, $file_to_search);

		}  
	 } 
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
    Список файлов:<br>';
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
        <td>/DIR</td>
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