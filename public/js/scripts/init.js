seajs.config({
	base: 'http://rtworker.localhost/',
	alias: {
    	jquery:'js/libs/jquery/1.8.1/jquery',
        'jquery-ui':  'js/plugins/jquery-ui/jquery-ui-1.10.0.custom.min',
        //'jquery-ui-css':  'css/jui/jquery.ui.min.css',
        'jquery-ui-css':  'js/plugins/jquery-ui/jquery-ui-1.10.0.custom.min.css',
        jqueryPlugins: 'js/plugins/jquery',
    	backbone:'js/libs/backbone/0.9.2/backbone',
    	underscore:'js/libs/underscore/1.3.3/underscore',
        json: 'js/libs/json/1.0.2/json',
        mustache: 'js/libs/mustache/0.5.0/mustache',
        //bootstrap: 'js/plugins/bootstrap/2.1.1',
        bootstrap: 'js/plugins/bootstrap.min',
        jasny: 'js/plugins/jasny-bootstrap.min',
        cufon: 'js/libs/cufon/cufon',
        dot : 'js/libs/dot/0.2.0/doT.min.js',
        fileuploader: 'js/plugins/fileupload2.1.2/fileuploader.min.js',
        apprise : 'js/plugins/apprise/apprise-1.5.min.js'
    },
    charset: 'utf-8',
    timeout: 20000,
    debug: 0
});

seajs.use('js/scripts/app');