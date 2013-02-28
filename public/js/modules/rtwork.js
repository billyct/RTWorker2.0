define(function(require, exports, module) {

    var $ = require('jquery');
    var uploader = require('js/modules/uploader');
    var functions = require('js/modules/functions');
    var alert = require('apprise');
    var _ = require('underscore');


    require('jquery-ui')($);
    require('js/plugins/bootstrap/select2-3.3.0/select2.min')($);
    //require('js/plugins/jquery/dropdown/dropdown')($);
    //require('jquery-ui-css');

    exports.component = function(){
        
        if ($('#component-image-fineuploader')[0]) {
            var file_upload = uploader.product_images_uploader(
                functions.base_url+'/component/upload_image',
                '#component-image-fineuploader'
            );
        }

        $('#btn-add-component').live('click', function(){
            var self = $(this);
            var form_component = self.parents('form');
            var options_id = new Array();
            var works = new Array();

            //属性
            $.each($('#option-tags').find('.option-well'), function(){
                options_id.push($(this).attr('dataid'));
            });

            //构件要打印的表格信息
            $.each($('#items tr.item-row'), function(i, n){

                works.push({
                    formula : $(n).find('#formula').val(),
                    type : $(n).find('#type').val(),
                    sum : $(n).find('#sum').val()
                });
                
            });


            var component_data = {
                name        : form_component.find('#component-name').val(),
                formula     : form_component.find('#component-formula').val(),
                category_id : form_component.find('#component-category').val(),
                image_id    : $('#component-image-fineuploader').find('input[name="image_id"]').val(),
                path_thumb  : $('#component-image-fineuploader').find('img').attr('src'),
                works       : works,
                options_id  : options_id
            }

            // console.log(component_data);
            // return false;

            functions.addbtn_function_dot(self, component_data, 'component_tr_tmpl', '#table-components tbody');

            $('#component-image-fineuploader').empty();

            var file_upload = uploader.product_images_uploader(
                functions.base_url+'/component/upload_image',
                '#component-image-fineuploader'
            );

            return false;

        });

    };


    exports.option = function() {

        var map,objects;
        $('#component-option').typeahead({
            source : function() {
                $input_option_name = $('#component-option');
                var option_name = $input_option_name.val();
                var url = $input_option_name.attr('search');

                $.ajax({
                    type: 'GET',
                    async: false,
                    url: url,
                    data: 'name='+option_name,
                    success: function(data){
                        objects = [];
                        map = {};

                        $.each(data['data'], function(i, object) {
                            map[object.name] = object;
                            objects.push(object.name);
                        });
                    },
                    dataType: 'json'
                });

                return objects;

            },
            updater: function(item) {

                $('#component-option').attr('dataid',(map[item].id));
                return item;
            }
        });
        $('#component-option').keypress(function(event){
            
            var self = $(this);
            if (event.keyCode == 13 && $('.typeahead:not(":visible")')[0]) {
                var option_name = self.val();
                var option_data = {
                    name : option_name
                };

                functions.addbtn_function_dot_free(self.attr('action'), option_data, 'option_tmpl', '#option-tags');

                return false;
            }
        });

        $('a#btn-close-option').live('click', function(){
            $(this).parent().remove();
        });
    };

    exports.category = function() {
        $('#btn-add-category').live('click', function(){
            var self = $(this);
            var category_name = $('#category-name').val();
            var category_form = self.parents('form[name="form-category"]');
            var category_data = {
                name : category_name
            };

            functions.addbtn_function_dot_free(category_form.attr('action'), category_data, 'category_tr_tmpl', '#categorys tbody');


            return false;
        });
    }

    exports.lofting = function() {
        var storage = window.localStorage;

        /** 单击构件得到构件的详情在构件panel里
        $('a#lofting-component').live('click', function(e){
            e.preventDefault();
            var self = $(this);
            
            var id = self.attr('data');
            var component_data = null;
            //判断是否有本地存储，如果有就直接拿本地的
            if (storage.getItem('component-'+id)) {
                component_data = JSON.parse(storage.getItem('component-'+id));
            }else {

                $.ajax({
                    type: 'GET',
                    url : self.attr('href'),
                    success: function(data){
                        component_data = data;
                        console.log(data);
                        storage.setItem('component-'+data.id, JSON.stringify(data));
                    },
                    dataType: "json",
                    async: false
                });
            }

            var tmpl = document.getElementById('component-info-tmpl').innerHTML;
            var doTtmpl = doT.template(tmpl);
            $('#component-panel').append(doTtmpl(component_data));
            
            return false;
        }); */

        /** 从构件panel删除某一个构件
        $('a#btn-remove-component-info').live('click', function(){
            $(this).parent().remove();
        }); */

        /** 清空构件panel
        $('#btn-empty-components').live('click', function(){
            $('#component-panel').empty();
        }); */

        /** 拖拽构件 */
        $('li#component-draggable').draggable({
            revert: "invalid",
            helper: "clone",
            cursor: "move",
            cursorAt: { top: 56, left: 56 },
            opacity: 0.7
        });

        //构件放置在计算槽里的事件
        $('#lofting-panel').parent().droppable({
            accept: 'li#component-draggable',
            activeClass: "ui-state-hover",
            hoverClass: "ui-state-active",
            drop: function( event, ui ) {
                $(this).addClass('lofting-panel');

                var insertComponent = ui.draggable.clone();
                var id = insertComponent.attr('data');
                
                var component_data = null;
                //判断是否有本地存储，如果有就直接拿本地的
                if (storage.getItem('component-'+id)) {
                    component_data = JSON.parse(storage.getItem('component-'+id));
                }else {

                    $.ajax({
                        type: 'GET',
                        url : insertComponent.attr('href'),
                        success: function(data){
                            component_data = data;
                            storage.setItem('component-'+data.id, JSON.stringify(data));
                        },
                        dataType: "json",
                        async: false
                    });
                }

                var tmpl = document.getElementById('component-config-tmpl').innerHTML;
                var doTtmpl = doT.template(tmpl);
                $('#lofting-panel').append(doTtmpl(component_data));

                type_select_load();


                $(this).find('.widget').draggable({
                    containment : $(this).parents('.row-fluid'),
                    handle: ".widget-head",
                    stack : '#lofting-panel .widget'
                });
              }
        });
        
        //配置panel上的toolbar控制
        $('button#btn-hide-config').live('click', function() {
            $(this).parents('#component-config-panel').find('.widget-content').toggle();
        });

        $('button#btn-hide-component-panel').live('click', function(){
            $(this).parents('.widget').find('.widget-content').toggle();
        });

        $('button#btn-remove-component-config').live('click', function(){
            var self = $(this);
            var lofting_component_id = parseInt(self.attr('lofting-component-id'));
            if (!isNaN(lofting_component_id)) {
                alert.apprise('确定删除该项目中的构件?', {'verify':true, 'textYes':'是', 'textNo':'否'}, function(r) {
                    if(r) {
                        $.post(self.attr('href'), {
                            id : self.attr('lofting-component-id')
                        }, function(data){
                            if (data.code == 1) {
                                self.parents('#component-config-panel').remove();
                            }
                        },'json');  
                    }
                });
            }else {
                self.parents('#component-config-panel').remove();
            }

            return false;
        });

        //排序翻样组件
        $( "#components-accordion" ).sortable({
          revert: true
        });

        //js计算
        $('a#btn-save-config').live('click', function(){
            var self = $(this);
            var config_panel = self.parents('#component-config-panel');

            var data_lofting = new Array;
            var data_work = new Array;
            var lofting_id = parseInt($('a#lofting-link.active').attr('data'));
            var component_id = parseInt(self.attr('component-id'));
            var lofting_component_id = parseInt(self.attr('lofting-component-id'));


            //属性数据
            $.each(config_panel.find('input[data-type="number"]'), function(i, n){
                var value = 0;

                if ($(n).val()!='') {
                    value = $(n).val();
                }
                $(n).val(value);

                data_lofting.push({
                    id : parseInt($(n).attr('lofting-data-id')),
                    option_id : parseInt($(n).attr('option-id')),
                    value : value
                });
            });

            //构件要打印的表格数据
            $.each(config_panel.find('li.type-select-li'), function(i, n){

                data_work.push({
                    id : parseInt($(n).attr('lofting-typedata-id')),
                    work_id : parseInt($(n).attr('work-id')), 
                    type : $(n).find('#type').val(),
                    sum : $(n).find('#sum').val()
                });
                
            });

            var lofting_data = {
                lofting_id : lofting_id,
                component_id : component_id,
                data_lofting : data_lofting,
                data_work : data_work
            };

            if (!isNaN(lofting_component_id)) {
                lofting_data.lofting_component_id = lofting_component_id;

            }

            //console.log(lofting_data);

            $.ajax({
                url: self.attr('href'),
                type: 'POST',
                data: lofting_data,
                success: function(data){
                            if (data.code == 1 && data.data) {
                                //变成更新模式
                                self.attr('lofting-component-id', data.data.id);
                                config_panel.find('button#btn-remove-component-config').attr('lofting-component-id', data.data.id);
                                $.each(config_panel.find('input[data-type="number"]'), function(a, n){
                                    for (var i = data.data.lofting_data_options.length - 1; i >= 0; i--) {
                                        if($(n).attr('option-id') == data.data.lofting_data_options[i].option_id){
                                            $(n).attr('lofting-data-id', data.data.lofting_data_options[i].id); 
                                        }
                                    }
                                });

                                $.each(config_panel.find('li.type-select-li'), function(i, n){
                                    for (var i = data.data.lofting_typedata_options.length - 1; i >= 0; i--) {
                                        if($(n).attr('work-id') == data.data.lofting_typedata_options[i].work_id) {
                                            $(n).attr('lofting-typedata-id', data.data.lofting_typedata_options[i].id);
                                        }
                                    }
                                });
                                
                            };
                        },
                async: false,
                dataType: 'json'
            });
            

            //获取数据库里的总数
            $.ajax({
                url: self.attr('href-total'),
                type: 'GET',
                data:  { lofting_id : lofting_id },
                success: function(data){
                            $('#total-value').html(data.total);
                            $('#formula-list').empty();
                            for (var i = data.formulas.length - 1; i >= 0; i--) {
                                $('#formula-list').append('<li>'+data.formulas[i]+'</li>');
                            };
                        },
                async: false,
                dataType: "json"
            });

            return false;


        });

        $('#dialog-add-lofting').dialog({
            autoOpen: false,
            modal: true,
            hide: "explode"
        });

        $('#btn-show-lofting-dialog').live('click', function() {
            $("#dialog-add-lofting").dialog('open');
        });

        $('#btn-add-lofting').live('click', function() {
            var self = $(this);
            var lofting_form = self.parents('form[name="form-lofting"]');
            var lofting_name = lofting_form.find('input[name="lofting-name"]').val();
            var lofting_data = {
                name: lofting_name
            };

            functions.addbtn_function_dot_free(lofting_form.attr('action'), lofting_data, 'lofting-li-tmpl', '#lofting-list');


            $("#dialog-add-lofting").dialog('close');

            $('a#lofting-link').draggable({
                revert: "invalid",
                opacity: 0.7
            });

            return false;

        });

        //加载项目
        $('a#lofting-link').live('click', function(){
            $('#lofting-panel').empty();
            var self = $(this);
            self.parents('.nav-submenu').find('a.active').removeClass('active');
            self.addClass('active');

            load_lofting(self);

            return false;
        });

        //第一次加载项目
        var first_load_lofting = function() {
            var lofting_link = $('a#lofting-link.active');
            load_lofting(lofting_link);
        }

        //加载项目信息到panel里以及一些设置
        function load_lofting(lofting_link) {
            $('#loading-block').show();
            $('#loading-block').fadeOut(function() {
                // 加载翻样项目
                $.get(lofting_link.attr('href'), function(data){
                    for (var i = data.length - 1; i >= 0; i--) {
                        var tmpl = document.getElementById('component-config-tmpl').innerHTML;
                        var doTtmpl = doT.template(tmpl);
                        $('#lofting-panel').append(doTtmpl(data[i]));
                        type_select_load();
                    };
                },'json');

                //获取数据库里的总数
                $.get(lofting_link.attr('href-total'), {
                    lofting_id : lofting_link.attr('data')
                }, function(data){
                    $('#total-value').html(data.total);
                    for (var i = data.formulas.length - 1; i >= 0; i--) {
                        $('#formula-list').append('<li>'+data.formulas[i]+'</li>');
                    };
                }, 'json');

                $('#goto_print_work').attr('href', $('#goto_print_work').attr('work-href')+'/'+lofting_link.attr('data'));

            }); 
        }

        first_load_lofting();

        
        //删除项目
        $('a#lofting-link').draggable({
            revert: "invalid",
            opacity: 0.7
        });

        $('#icon-delete-lofting').droppable({
            accept: 'a#lofting-link',
            activeClass: "ui-state-hover",
            hoverClass: "ui-state-active",
            drop: function( event, ui ) {
                var self = $(this);
                var lofting_id = ui.draggable.attr('data');

                alert.apprise('确定删除项目?', {'verify':true, 'textYes':'是', 'textNo':'否'}, function(r) {
                    if(r) {
                        $.post(self.attr('href'), {
                            id : lofting_id
                        }, function(data){
                            if (data.code == 1) {
                                ui.draggable.remove();
                            }else{
                                ui.draggable.attr('style','position: relative;');
                            }
                        }, 'json');
                        
                    }else{
                        ui.draggable.attr('style','position: relative;');
                    }
                });
                
            }
        });


    }


    function type_select_format(state) {
        var originalOption = state.element;
        if (!state.id) return state.text;
        return '<img class="type-icon" src="'+$(originalOption).data('image')+'.png" />'+state.text;
    }

    function type_select_load() {
        var select = $('select.type-select:visible');
        $.each(select, function(i, n){
            $(n).find('option[value="'+$(n).attr('val')+'"]').attr('selected', 'selected');
        });
        
        select.select2({
            formatResult: type_select_format,
            formatSelection: type_select_format,
            escapeMarkup: function(m) { return m; }
        });

        $('.select2-container.type-select').removeClass('select2-offscreen');
    }

    exports.work = function() {
        $('#invoice-page-wrapper #add-row').live('click', function(){
            var row_tmpl = document.getElementById('item-row-tmpl').innerHTML;
            $(this).parents('table').find("tr:last").before(row_tmpl);

            //type_select_load();
        });

        $('#invoice-page-wrapper #delete-row').live('click', function(){
            $(this).parents('.item-row').remove();
        });

        
        
        // $('select.type-select').select2({
        //     formatResult: type_select_format,
        //     formatSelection: type_select_format,
        //     escapeMarkup: function(m) { return m; }
        // });
       
    }
    

});