window.setInterval(function() {reloadFrame()},60000);
function reloadFrame() {
		//document.frames["reggraph"].location.reload();
		document.getElementById('reggraph').contentWindow.location = "../res/tasgraphregproj.php";
		document.getElementById('clsgraph').contentWindow.location = "../res/tasgraphclsproj.html";
		document.getElementById('opengraph').contentWindow.location = "../res/tasgraphopenproj.html";
	}
