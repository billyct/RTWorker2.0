define(function(require, exports, module) {

    var $ = require('jquery');
    var alert = require('apprise');
    require('js/plugins/jquery/mobileMenu')($,window,document);

    exports.nav = function(){
        $('[data-menu=mobile]').mobileMenu();
    }

    exports.nav_side = function() {
        $('.link_side').live('click', function(){
            var self = $(this);
            var div_id = self.attr('href');
            //加载表单
            $('.div_href').hide();
            $(div_id).show();
            $('#breadcrumb-title').text(self.text());
            //修改导航边栏的样式
            // self.parents('li').siblings('.current_link').removeClass();
            // self.parents('li').addClass('active current_link');
            self.parents('.nav-submenu').find('a.active').removeClass('active');
            self.addClass('active');

        });
    }

    exports.nav_tip = function() {
        $('[rel="tooltip"]').tooltip({
            placement : 'top'
        });
    }

    exports.delete_link = function() {
        $('.delete-link').live('click', function(){
            var self = $(this);
            var attr_data = $(this).attr('data');
            var delete_link = $(this).attr('href');
            if (attr_data) {
                $.post(delete_link, {
                    id : attr_data
                }, function(data){
                    data = $.parseJSON(data);
                    alert.apprise(data['msg'], {'animate': true, 'textOk': '确定'});
                    if (data['code'] == 1) {
                        self.parents('tr').remove();
                    }
                });
            }else {
                self.parents('tr').remove();
            }

            return false;
        });
    }

});