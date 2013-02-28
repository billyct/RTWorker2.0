define(function(require, exports, module) {

    var $ = require('jquery');
    require('jasny')();
    require('bootstrap')();
    
    
    // var i18n = require('js/scripts/i18n');
    // var moment = require('js/plugins/moment');
    // require('bootstrap/bootstrap-popover')($);
    // require('js/plugins/pikaday')();

    // var picker = new Pikaday({ 
    //     field: $('.datepicker')[0],
    //     i18n: i18n.pikaday,
    //     minDate: moment().toDate(),
    //     onSelect: function() {
    //         console.log(this.getMoment().format('Do MMMM YYYY'));
    //         $('#end_at').popover({
    //             placement: 'bottom',
    //             content: this.getMoment().format('YYYY-MM-DD')+document.getElementById('time_select_tmpl').innerHTML,
    //             title: '竞标截止<a class="close" id="time_close_link" href="javascript:void(0)">&times;</a>'
    //         });
    //         $('#end_at').popover('show');
    //         $('#time_close_link').live('click', function(){$('#end_at').popover('destroy');})
    //     }
    // });

    // console.log(moment("20111031", "YYYYMMDD").fromNow());

    $('#loading-block').fadeOut(function() {
       console.log('have fun');
    });

    var user = require('js/modules/user');
    user.register();


    var rtwork = require('js/modules/rtwork');
    rtwork.component();
    rtwork.option();
    rtwork.category();
    rtwork.lofting();
    rtwork.work();

    var main = require('js/modules/main');
    main.nav();
    main.nav_side();
    main.nav_tip();
    main.delete_link();


});