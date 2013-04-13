function assert(a, msg) {
	if (a) {
		console.log("TEST", msg, a);
	} else {
		console.error("TEST", msg, a);
	} 
}
	
var TheBase = function () {
	oop.newInstance(this, TheBase);
};
TheBase.$ptt = {};
TheBase.$name = "TheBase";
	
var TheAncestor = function () {
	oop.newInstance(this, TheAncestor);
};
TheAncestor.$ptt = {
	theMethod: [oop.VISIBILITY_PUBLIC, function () {
		console.log("theMethod in TheAncestor");
		var self = oop.fetchSelf(TheAncestor, this);
		var parent = oop.fetchParent(TheAncestor, this);
		var $this = oop.fetchInstance(this);
		
		$this.theProperty ++;
	}],
	ovTest: [oop.VISIBILITY_PUBLIC, function (t) {
		var self = oop.fetchSelf(TheAncestor, this);
		var parent = oop.fetchParent(TheAncestor, this);
		var $this = oop.fetchInstance(this);
		if (!t) {
			assert("TheAncestor::ovTest" === self.ovTest(1), "self.ovTest()");
			assert("TheClass::ovTest" === $this.ovTest(1), "$this.ovTest()");
		}
		return "TheAncestor::ovTest";
	}]
};
TheAncestor.$name = "TheAncestor";
TheAncestor.$base = TheBase;
	
var TheClass = function () {
	oop.newInstance(this, TheClass);
};
TheClass.$name = "TheClass";
TheClass.$base = TheAncestor;
	
TheClass.$ptt = {
	theMethod: [oop.VISIBILITY_PUBLIC, function () {
		var self = oop.fetchSelf(TheClass, this);
		var parent = oop.fetchParent(TheClass, this);
		var $this = oop.fetchInstance(this);
		console.log(parent, $this.theProperty);
		$this.theProperty ++;
		parent.theMethod();
		assert("TheClass::pvTest" === $this.pvTest(), "$this.pvTest()");
		assert("TheClass::ovTest" === $this.ovTest(), "$this.ovTest()");
		assert("TheAncestor::ovTest" === parent.ovTest(), "parent.ovTest()");
	}],
	pvTest: [oop.VISIBILITY_PRIVATE, function (t) {
		var self = oop.fetchSelf(TheClass, this);
		var parent = oop.fetchParent(TheClass, this);
		var $this = oop.fetchInstance(this);
		return "TheClass::pvTest";
	}],
	ovTest: [oop.VISIBILITY_PUBLIC, function (t) {
		var self = oop.fetchSelf(TheClass, this);
		var parent = oop.fetchParent(TheClass, this);
		var $this = oop.fetchInstance(this);
		if (!t) {
			assert("TheClass::ovTest" === $this.ovTest(1), "$this.ovTest()");
		}
		assert("TheAncestor::ovTest" === parent.ovTest(1), "parent.ovTest()");
		return "TheClass::ovTest";
	}],
	theStaticMethod: [oop.VISIBILITY_PUBLIC, function () {
		var self = oop.fetchSelf(TheClass, null);
		var parent = oop.fetchParent(TheClass, null);
	}],
	theProperty: [oop.VISIBILITY_PUBLIC, 10]
};
	
var tClass = new TheClass();
	console.log(tClass);
	tClass.theMethod();
	tClass.ovTest();
	tClass.pvTest();
	console.log(tClass.theProperty);