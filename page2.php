		<main>
			<p>Return to main page after</p>
			<p id="clock"></p>
			<script>
				setInterval(myTimer, 1000);
				var h = 3;
				document.getElementById("clock").innerHTML = h + " sec";

				function myTimer() {
					h = h-1;
					document.getElementById("clock").innerHTML = h + " sec";
				}
			</script>
		</main>