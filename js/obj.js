var obj = (function (_) {

	var ref = function (object, method) {
		return function () {
			return method.apply(object, arguments);
		};
	};
	
	return {
		class: (function (elements, extend, implements) {
			var cls = (function () {
				var s = this;
				
				if (extend) {
					var p = new extend;
					s._staticParent = {};
					s['$parent'] = {};
					_.each(p, function (v, k) {
						s[k] = typeof v === "function" ? ref(s, v) : v;
						if (typeof v === "function") {
							s._staticParent[k] = v;
							s['$parent'][k] = ref(s, v);
						}
					});
				}
				
				_.each(elements, function (v) {
					v.init(s);
				});
				
				if (typeof s['__construct'] !== "undefined") {
					s.__construct();
				}
			});
			
			cls._obj = {
				elements: elements,
				extend: extend,
				implements: implements
			};
			
			if (extend) {
				cls['$parent'] = {};
				_.each(extend, function (v, k) {
					cls[k] = typeof v === "function" ? v : v;
					cls['$parent'][k] = typeof v === "function" ? v : v;
				});
			}
			
			_.each(elements, function (v) {
				v.static(cls);
			});
			
			return cls;
		}),
		
		method: function (name, f) {
			this.static = function (cls) {
				
			};
			this.init = function (instance) {
				instance[name] = ref(instance, f);
			};
		},
		
		staticMethod: (function (name, f) {
			this.static = function (cls) {
				cls[name] = ref(cls, f);
			};
			this.init = function (instance) {
			};
		}),
		
		property: (function (name, defaultval) {
			var s = this;
			
			s.isStatic = false;
			s.static = function (cls) {
				if (s.isStatic) {
					cls[name] = defaultval;
				}
			};
			s.init = function (instance) {
				if (!s.isStatic) {
					instance[name] = defaultval;
				}
			};
		}),
				
		propertyGroup: (function (visibility, elements) {
			this.static = function (cls) {
				_.each(elements, function (v) {
					v.static(cls);
				});
			};
			
			this.init = function (instance) {
				_.each(elements, function (v) {
					v.init(instance);
				});
			};
		}),
				
		staticPropertyGroup: (function (visibility, elements) {
			_.each(elements, function (v) {
				v.isStatic = true;
			});
			
			this.static = function (cls) {
				_.each(elements, function (v) {
					v.static(cls);
				});
			};
			
			this.init = function (instance) {
				_.each(elements, function (v) {
					v.init(instance);
				});
			};
		}),
				
		interface: (function () {
			this.static = function (cls) {};
			this.init = function (instance) {
			};
		})
	};
	
})(_);