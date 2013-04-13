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