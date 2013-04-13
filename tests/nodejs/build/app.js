//package app
define([], function () {var $express=require('express');
var $app=$express();
$app.configure('development',function () {$app.engine('.html',(cons + swig));
$app.set('view engine','html');
swig.init({'root': './view','allowErrors': true});
$app.set('views','./view/');
$app.use('/pub',$express.static((__dirname + '/pub')));
});
$app.get('/',function ($req,$res) {console.log('/ start');
setTimeout(function () {console.log('/ cnt');
$res.send('<a href="/users">View users</a>');
},30000);
console.log('/ end');
});
$app.listen(3000);
return {};})