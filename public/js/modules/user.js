define(function(require, exports, module) {

    var $ = require('jquery');

    exports.register= function() {
        $('.register_input').focusout(function(){
            var self = $(this);
            var name = self.attr('name');
            var data_upload = {};
            data_upload[name] = self.val();
            $.post('/user/reg_validate/'+name, data_upload, function(data){
                data = $.parseJSON(data);
                var help = self.parent('div').find('.help-inline').empty();
                help.html(data['msg']);
            });
        });

        $('#password_reg').focusout(function(){
            document.getElementById('password_reg').type='password';
        });

        $('#password_reg').focusin(function(){
            document.getElementById('password_reg').type='text';
        });
    }

});