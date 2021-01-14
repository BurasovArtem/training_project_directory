function make_XHR(METHOD, LINK, SYNC, BODY, CALLBACK) {
	let xhr = new XMLHttpRequest();

	xhr.open(METHOD, LINK, SYNC);

	xhr.onreadystatechange = function () {
		if (xhr.readyState == 4) {
			CALLBACK(xhr.responseText);
		}
	}

	xhr.send(BODY);
}