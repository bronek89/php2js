//package testspace
define(['./story'], function (story) {var board = story.board;var makefoo = {},foocls = {},foocls_ex = {},barcls = {};barcls = obj.class([new obj.propertyGroup("public", [new obj.property('x', 0)]),new obj.method('title', function title() { var $this = this; var self = this; var parent = null;})],null, []);
foocls = obj.class([new obj.method('test', function test() { var $this = this; var self = this; var parent = this["$parent"];console.log($this.param); 
return (1); 
}),new obj.staticMethod('test_s', function test_s() { var $this = this; var self = this; var parent = this["$parent"];return (2); 
}),new obj.staticMethod('make', function make() { var $this = this; var self = this; var parent = this["$parent"];console.log(self.test_s()); 
return (makefoo()); 
})],barcls, []);
foocls_ex = obj.class([new obj.propertyGroup("public", [new obj.property('param', 10)]),new obj.method('test', function test() { var $this = this; var self = this; var parent = this["$parent"];console.log($this.param); 
return ((3 + parent.test())); 
})],foocls, []);;
makefoo = function () {return (new foocls());
};
;
;
$foo=new foocls_ex();
console.log($foo.test());
;
return {makefoo: makefoo,foocls: foocls,foocls_ex: foocls_ex,barcls: barcls};})