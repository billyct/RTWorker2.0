define(function(require, exports, module) {

    var $ = require('jquery');
    var doT = require('dot');
    var _ = require('underscore');
    var alert = require('apprise');

    exports.addbtn_function_dot = function(self, data_insert, tmpl_id, append_id) {
		$.post(self.parents('form').attr('action'), data_insert, function(data){
			//data = $.parseJSON(data);
			_.extend(data_insert, data['data']);
			alert.apprise(data['msg'], {'animate': true, 'textOk': '确定'});
			if (data['code'] == 1) {

				var tmpl = document.getElementById(tmpl_id).innerHTML;
				var doTtmpl = doT.template(tmpl);
				//console.log(data_insert);
				$(append_id).append(doTtmpl(data_insert));
			};
		},'json');
	};


	exports.addbtn_function_dot_free = function(action_url, data_insert, tmpl_id, append_id) {
		$.post(action_url, data_insert, function(data){
			_.extend(data_insert, data['data']);
			if (data['code'] == 1) {

				var tmpl = document.getElementById(tmpl_id).innerHTML;
				var doTtmpl = doT.template(tmpl);
				//console.log(data_insert);
				$(append_id).append(doTtmpl(data_insert));
			}else {
				alert.apprise(data['msg'], {'animate': true, 'textOk': '确定'});
			};
		},'json');
	};

	exports.addbtn_function = function(self, data_insert) {
		$.post(self.parents('form').attr('action'), data_insert, function(data){
			alert.apprise(data['msg'], {'animate': true, 'textOk': '确定'});
			if (data['code'] == 1) {

			};
		},'json');
	}





	exports.base_url = 'http://rtworker.localhost';

});
