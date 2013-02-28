define(function(require, exports, module) {

    var $ = require('jquery');
    var qq = require('fileuploader');

    require('js/plugins/fileupload2.1.2/fileuploader.css');
    exports.product_images_uploader = function(action_link, file_div_id){
        return new qq.FileUploader({
            element: $(file_div_id)[0],
            action: action_link,
            debug: false,
            autoUpload: true,
            multiple: true,
            allowedExtensions: ['jpeg', 'jpg', 'png'],
            sizeLimit: 5120000, // 5000 kB = 5000 * 1024 bytes
            uploadButtonText: '添加图片，支持拖拽',
            showMessage: function(message) {
                $(file_div_id).append('<div class="alert alert-error">' + message + '</div>');
            },
            onComplete: function(id, fileName, responseJSON) {
                console.log(responseJSON);
                if (responseJSON.success) {
                    $(file_div_id).append('<img src="'+responseJSON.path_thumb+'" alt="' + fileName + '">');
                    $(file_div_id).append('<input type="hidden" name="image_id" value="'+responseJSON.id+'"/>')
                }
            }
        });
    }
});