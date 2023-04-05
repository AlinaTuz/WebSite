<?php
    if(isset($JS_FILES) && (count($JS_FILES)>0))
    {
        foreach($JS_FILES as $jsfile)
            echo '<script src = "'.$jsfile.'"></script>';
    }
?>
		<footer>
			<div>
				<img src="images/squa.png">
				<div id="copy">© Copyright 2002 WEBHOSTING Corporation. All Rights Reserved.</div>	
			</div>			
		</footer>	
	</body>
</html>