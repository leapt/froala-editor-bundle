1.4.0
-----

* File uploads: improve message when the request may be truncated
* Error events: add response parameter to JS function call
* Error events: allow to call different JS functions for each event

1.3.2
-----

* File uploads: set status code & make it fail if file upload fails for some reason

1.3.1
-----

* Run CI against PHP 8.2
* Don't register JS function if already loaded (may happen using symfony/ux-turbo)

1.3.0
-----

* Test Symfony 6.1 in CI
* Improve .gitattributes
* Add missing options & add a test to compare options from docs with the ones in the bundle

1.2.0
-----

* Add PHP routing config
* Rewrite services config with PHP

1.1.0
-----

* Drop support for Symfony < 5.4
* Fix variable if customJS is defined

1.0.0
-----

Initial release.
