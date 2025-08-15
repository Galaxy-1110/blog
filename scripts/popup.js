function showPopup(message, type) {
	var popup = document.createElement("div");
	popup.className = "popup " + type;
	popup.innerHTML = "<p>" + message + "</p>";
	document.body.appendChild(popup);
	popup.classList.add("show");

	setTimeout(function () {
		popup.classList.remove("show");
		popup.classList.add("hide");
		setTimeout(function () {
			document.body.removeChild(popup);
		}, 500);
	}, 5000);
}
