//package app
define(['./app/entity'], function (entity) {var news = entity.news;var app = {};app = function () {if (typeof this.__construct !== 'undefined') {this.__construct()}};app.prototype.__construct = function __construct() { var $this = this; var self = app; var $news=new news();
$news.setTitle('Hello world!');
var $comments=$news.getComments();
console.log($news.getTitle());
console.log($comments[0].tableName);
};
;
;
return {app: app};})