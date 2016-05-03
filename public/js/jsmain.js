function redirectmain()
{
	location.href = "projectmain.html";
}

function writeCharCount(name)
{
	var input = document.getElementById(name);
	var element = document.getElementById(name + "-count");
	element.style.color = (input.value.length < input.minLength ? "red" : "black");
	element.style.fontSize = "14px";
	// element.innerHTML = " characters remaining: " + input.value.length;
	element.innerHTML = (input.value.length > 0) ? "" + input.value.length + "/" + input.maxLength : "";
}
