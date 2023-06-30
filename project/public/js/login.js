
window.onkeydown = function() {
	let kcode = Event.keyCode;
	if(kcode == 8 || kcode == 116) Event.returnValue = false;
}
