var obj = {
	clone: function(obj) {
		var clone, property, value;
		if (!obj || typeof obj !== 'object') {
			return obj;
		}
		clone = typeof obj.pop === 'function' ? [] : {};
		clone.__proto__ = obj.__proto__;
		for (property in obj) {
			if (obj.hasOwnProperty(property)) {
				value = obj.property;
				if (value && typeof value === 'object') {
					clone[property] = obj.clone(value);
				} else {
					clone[property] = obj[property];
				}
			}
		}
		return clone;
	}
};
	
var A = function () {
	this.property = 11;
};
A.staticProperty = 10;
A.staticMethod = A.prototype.staticMethod = function () {
	var self = B;
};
A.prototype.method = function () {
	var $this = this;
	var self = A;
	ref(this, self.prototype.staticMethod)();
};
	
var B = function () {
	this.property = 11;
};
B.prototype = obj.clone(A.prototype);
B.staticProperty = 10;
B.staticMethod = B.prototype.staticMethod = function () {
	var self = B;
	var parent = A;
	self.staticCallMethod(); // self::staticCallMethod();
	self.nonStaticMethod(); // self::nonStaticMethod();
};
B.prototype.method = function () {
	var $this = this;
	var self = B;
	var parent = A;
	ref(this, parent.prototype.staticMethod)(); // parent::staticMethod();
	ref(this, self.prototype.staticMethod)(); // self::staticMethod();
	ref(this, self.prototype.nonStaticMethod)(); // self::nonStaticMethod();
	$this.nonStaticMethod(); // $this->nonStaticMethod();
};
