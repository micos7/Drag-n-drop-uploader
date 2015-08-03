

<html>
<head>
	<title>Upload files</title>
	<link rel="stylesheet" type="text/css" href="css/body.css">
</head>
<body>
<div id="uploads"></div>
<div class="dropzone" id="dropzone">Drop files to upload</div>
<script type="text/javascript">
	(function(){

var dropzone = document.getElementById('dropzone');

var displayUploads = function(data){
	var uploads = document.getElementById('uploads'),
	anchor,
	x;

	for (x=0;x<data.length;x=x+1) {
		anchor = document.createElement('a');
		anchor.href = data[x].file;
		anchor.innerText=data[x].name;
		uploads.appendChild(anchor);
	}
}

var upload = function(files){
	var formData = new  FormData(),
	xhr = new XMLHttpRequest(),
	x;

	for(x=0;x<files.length;x=x+1){

		formData.append('file[]',files[x]);
	}

	xhr.open('post','upload.php');
	xhr.send(formData);

	xhr.onload = function(){
		console.log(this.responseText);
		var data = JSON.parse(this.responseText);

		displayUploads(data);
	}
}

dropzone.ondrop = function(e){
	e.preventDefault();
	this.className='dropzone';
	upload(e.dataTransfer.files);
};


dropzone.ondragover = function(){
	this.className = 'dropzone dragover';
	return false;
};

dropzone.ondragleave = function(){
	this.className = 'dropzone';
	return false;
};
	}());

</script>

</body>
</html>