CHANGELOG
=========

* throw an exception when not existing document data is accessed instead of
  failing with a PHP notice

* all values of a score are optional, pass `null` to omit them

* values passed to the constructor of the `Score` class are no longer cast to
  `float`

0.2.0
-----

* added a dedicated class to refer to inverse functional identifiers, refer to
  the upgrade file for more detailed information

* marked the `Statement` class as final

0.1.0
-----

This is the first release containing immutable and final classes that reflect
all parts of Experience API statements.

This package replaces the `xabbuh/xapi-model` package which is now deprecated
and should no longer be used.
