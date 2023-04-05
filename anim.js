
function deltaLinear(progress){
	return progress;
}
function deltaAccel(progress){
	return Math.pow(progress, 2);
}
function deltaAccelDown(progress){
	return ( 1 - deltaAccel(1 - progress) );
}

function runAnimBase(objid)
{
	var element = document.getElementById(objid);
	var from = 10; // Начальная координата X
	var to = 870; // Конечная координата X
	var duration = 2000; // Длительность - 1 секунда
	var fps = 100;		// 40 кадров в секунду
	var fps_tick = (1000 / fps);		// 25 миллисекунд
	var start = new Date().getTime(); // Время старта
	
	setTimeout(function() {
	    var now = (new Date().getTime()) - start; // Текущее время
		
	    var progress = now / duration; // Прогресс анимации - K - 0:1
		if( progress > 1 )
			progress = 1;
			
		var delta = deltaLinear(progress);
		delta = deltaAccelDown(progress);
	    var result = (to - from) * delta + from;
	    
		element.style.left = result + "px";
	    if (progress < 1) // Если анимация не закончилась, продолжаем
	        setTimeout(arguments.callee, fps_tick);					
	}, 10);
}

function Act(objid)
{
	
	runAnimBase(objid);
}





