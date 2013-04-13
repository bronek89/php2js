var oop = (function (_) {
	
	var ref = function (object, method) {
		return function () {
			return method.apply(object, arguments);
		};
	};
	
	return {
		"newInstance": function (instance, classObject) {
			var baseClass = classObject.$base;
			
			if (typeof instance.$byClass === "undefined") {
				instance.$byClass = {};
			}
			
			instance.$byClass[classObject.$name] = {};
			
			if (baseClass) {
				oop.newInstance(instance, baseClass);
			}
			
			_.each(classObject.$ptt, function (prop, k) {
				var v = prop[1];
				var visibility = prop[0];
				v = (typeof v === "function" ? ref(instance, v) : v);
				
				if (visibility === oop.VISIBILITY_PUBLIC) {
					instance[k] = v;
				}
				
//				if (visibility >= oop.VISIBILITY_PROTECTED) {
//					_.each(instance.$byClass, function (bc,bk) {
//						if (typeof bc[k] === "undefined") {
//							console.log("set function", classObject.$name, "::", k, "on", bk);
//							bc[k] = v;
//						}
//					});
//				}
				
				instance.$byClass[classObject.$name][k] = v;
			});
		},
		
		"fetchInstance": function (instance) {
			return instance;
		},
		
		"fetchSelf": function (classObject, instance) {
			return instance ? instance.$byClass[classObject.$name] : classObject.$ptt;
		},
				
		"fetchParent": function (classObject, instance) {
			return instance ? instance.$byClass[classObject.$base.$name] : classObject.$ptt;
		},
				
		VISIBILITY_PRIVATE: 0,
		VISIBILITY_PROTECTED: 1,
		VISIBILITY_PUBLIC: 2
	};
	
})(_);