requirejs.config({
    baseUrl: 'build'
});
	
requirejs(['app'], function (app) {
	new app.app;
});