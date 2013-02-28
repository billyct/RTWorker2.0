define(function(require, exports, module) {

    var $ = require('jquery');
    var uploader = require('js/modules/uploader');
    var functions = require('js/modules/functions');
    exports.init = function(){
        
        var file_upload = uploader.product_images_uploader(
            functions.base_url+'/component/upload_image',
            '#component-image-fineuploader'
        );

        

        $('#btn_addproduct').live('click', function() {
            var self = $(this);
            var form_product = self.parents('form');
            var images_id = new Array();
            $.each($('#product-images-fineuploader').find('input[name="image_id"]'), function(){
                images_id.push($(this).val());
            });
            var product_data = {
                product_name : form_product.find('input[name="product_name"]').val(),
                product_desc : form_product.find('textarea[name="product_desc"]').val(),
                category_id  : form_product.find('select[name="category_id"]').val(),
                images_id    : images_id
            }

            functions.addbtn_function(self, product_data);

            $('#product-images-fineuploader').empty();
                var file_upload = uploader.product_images_uploader(
                'http://shutup.localhost/admin/product/upload_image',
                '#product-images-fineuploader'
            );
            form_product.find('input[name="product_name"]').val('');
            form_product.find('textarea[name="product_desc"]').val('');
            //form_product.find('select[name="category_id"]').val('');
            
            return false;
        });
    }
    

});