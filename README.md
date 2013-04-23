php2js
======
php2js (prototype name) is php to javascript translator with support for namespaces and classes (partial)

It uses RequireJS to including namespaces. Each PHP namespace translates to RequireJS module.
For example two PHP files:

foo.php

```php
namespace xyz {
  class foo {}
}
```

and bar.php

```php
namespace xyz {
  class bar {}
}
```

translates into one JS module:

```js
define([], function() {
  var foo = {}, bar = {};
	foo = function() {
		if (typeof this.__construct !== 'undefined') {
			this.__construct()
		}
	};
	bar = function() {
		if (typeof this.__construct !== 'undefined') {
			this.__construct()
		}
	};
	return {foo: foo, bar: bar};
});
```
