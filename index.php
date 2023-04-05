<?php
	include "inc/init_inc.php";
	
	$page = getHttpVar("page", "index");
	$page_view = "";
	
	switch($page)
	{
		case "index":
			include "pages/index_inc.php";
			break;
		case "page1":
			include "pages/page1_inc.php";
			break;
		case "page2":
			include "pages/page2_inc.php";
			break;
		case "server":
			include "pages/server_inc.php";
			break;
		case "file":
			include "pages/file_inc.php";
			break;
		case "shop":
			include "pages/shop_inc.php";
			break;
		default:
			header("HTTP/1.1 404 NOT FOUND");
			exit();
	}
	
	include "inc/header_inc.php";
	
	switch($page_view)
	{
		case "index":
			include "views/index.php";
			break;
		case "page1":
			include "views/page1.php";
			break;	
		case "page2":
			include "views/page2.php";
			break;
		case "server":
			include "views/server.php";
			break;
		case "file":
			include "views/file.php";
			break;
		case "shop":
			include "views/shop.php";
			break;
	}

	include "inc/footer_inc.php";
