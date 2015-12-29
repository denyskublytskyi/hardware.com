window.onload = function(){
    var dropzone = document.getElementById('dropzone');

    dropzone.ondrop = function(event) {
        event.preventDefault();
        this.className = 'dragover';
        upload(event.dataTransfer.files);
    };

    dropzone.ondragover = function() {
        this.className = 'dragover';
        return false;
    };

    dropzone.ondragleave = function() {
        this.className = '';
        return false;
    }
};

function upload(files) {
    var data = new FormData();

    console.log(files);
    for(var i = 0; i < files.length; i++)
        data.append('files[]', files[i]);

    $.ajax({
        url: '/admin/addImage',
        type: 'post',
        data: data,
        processData: false,
        contentType: false,
        success: function(data) {
            $('#image-preview').append(data);
        }
    });
}





