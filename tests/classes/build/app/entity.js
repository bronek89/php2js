//package app/entity
define([], function () {var news = {},comment = {};news = function () {if (typeof this.__construct !== 'undefined') {this.__construct()}};news.prototype.tableName = 'news';
;
news.prototype.getComments = function getComments() { var $this = this; var self = news; return ({0: new comment()});
};
news.prototype.id = null;
news.prototype.title = null;
news.prototype.date = null;
;
news.prototype.getTableName = function getTableName() { var $this = this; var self = news; return ($this.tableName);
};
news.prototype.setTableName = function setTableName($tableName) { var $this = this; var self = news; $this.tableName=$tableName;
};
news.prototype.getId = function getId() { var $this = this; var self = news; return ($this.id);
};
news.prototype.setId = function setId($id) { var $this = this; var self = news; $this.id=$id;
};
news.prototype.getTitle = function getTitle() { var $this = this; var self = news; return ($this.title);
};
news.prototype.setTitle = function setTitle($title) { var $this = this; var self = news; $this.title=$title;
};
news.prototype.getDate = function getDate() { var $this = this; var self = news; return ($this.date);
};
news.prototype.setDate = function setDate($date) { var $this = this; var self = news; $this.date=$date;
};

comment = function () {if (typeof this.__construct !== 'undefined') {this.__construct()}};comment.prototype.tableName = 'comment';
;
;
;
return {news: news,comment: comment};})