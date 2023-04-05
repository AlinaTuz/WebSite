<?php
	if(isset($_POST['save']))
	{
		$name = $_POST['name'];
		$surn = $_POST['surname'];
		$patr = $_POST['patr'];
		$hobb = isset($_POST['hobby']) ? $_POST['hobby'] : array();	

  		$errorMessage = "";
		$count = 0;

		if(strlen($name) == 0) {  
			$errorMessage .= "Введите имя! ";   
		}
		if(strlen($surn) == 0) {  
			$errorMessage .= "Введите фамилию! ";  
		}
		if(strlen($patr) == 0) {  
			$errorMessage .= "Введите отчество! ";  
		}
		foreach ($hobb as $value) { 
    			$count = $count + 1;
		}
		if($count > 3) {
			$errorMessage .= "Нельзя выбрать больше 3 вариантов! ";
		}
		if(strlen($errorMessage) > 0) {
        		echo "<script>alert('$errorMessage');</script>"; 
		}
	}
?>
		<main>
			<div id="contact">
				<div id="cont">
					<span id="c">contact</span>
					<div id="arrowr"><img src="images/arrow.png"></div>
				</div>
				<div style="padding-top: 8px; padding-bottom: 10px;"
					<span id="data">Enter your data:</span>
					<form id="form" action="" method="POST">
					<input type="hidden" name="action" value="procfrm">
					<div id="newdata">
						<span style="display: block"><label>Имя:</label><input type="text" id="name" name="name"></span>
						<span style="display: block"><label>Фамилия:</label><input type="text" id="surname" name="surname"></span>
						<span style="display: block"><label>Отчество:</label><input type="text" id="patr" name="patr"></span>
					</div>
					
						<label><input type="checkbox" value="1" name="hobby[]">Учеба</label><br>
						<label><input type="checkbox" value="2" name="hobby[]">Спорт</label><br>
						<label><input type="checkbox" value="3" name="hobby[]">Музыка</label><br>
						<label><input type="checkbox" value="4" name="hobby[]">Чтение</label><br>
						<label><input type="checkbox" value="5" name="hobby[]">Танцы</label><br>
						<p><input type="submit" id="but" name="save" value="enter"></p>
					</form>				
				</div>
			</div>		
		</main>