var A = (function () {
	
	var _A = function () {
		this.property = 11;
	};
	_A.staticProperty = 10;
	_A.staticMethod = _A.prototype.staticMethod = function () {
		var self = _B;
	};
	_A.prototype.method = function () {
		var $this = this;
		var self = _A;
		ref(this, self.prototype.staticMethod)();
	};
	return _A;
	
});
var B = (function () {
	
	var _B = function () {
		this.property = 11;
	};
	_B.prototype = A.prototype;
	_B.staticProperty = 10;
	_B.staticMethod = _B.prototype.staticMethod = function () {
		var self = _B;
		var parent = A;
	};
	_B.prototype.method = function () {
		var $this = this;
		var self = _B;
		var parent = A;
		ref(this, parent.prototype.staticMethod)();
		ref(this, self.prototype.staticMethod)();
		_B.staticMethod();
	};
	return _B;
	
});