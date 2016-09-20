UPGRADE
=======

Upgrading from 0.4 to 0.5
-------------------------

* The constructor of the `SubStatement` class now throws an exception when
  a `SubStatement` instance is passed as the `$object` argument to comply
  with the Experience API spec which does not allow to nest sub statements.

* The `$id` attribute has been removed from the `SubStatement` class. Also,
  the `$id` argument of the class constructor has been removed respectively.
  The first constructor argument is now the sub statement's actor.

* The `getStatementReference()` and `getVoidStatement()` methods have been
  removed from the `SubStatement` class as they are not usable without an id.

Upgrading from 0.3 to 0.4
-------------------------

* The argument type of the `equals()` method in the `Actor` base class was
  changed from `Actor` to `Object` to be compatible with the same method from
  the parent `Object` class.

Upgrading from 0.2 to 0.3
-------------------------

* The default value of the `display` property of the `Verb` class was changed
  to `null` (was the empty array before).

Upgrading from 0.2.0 to 0.2.1
-----------------------------

* Data passed to the `Score` class during construction is no longer cast to
  `float` values to ensure that integers are not needlessly cast. You need to
  make sure to always pass the expected data types when build `Score` objects.

Upgrading from 0.1 to 0.2
-------------------------

* the getter methods to retrieve the inverse functional identifier properties
  `mbox`, `mboxsha1sum`, `openid`, and `account` have been removed from the
  `Actor` class

* the `getInverseFunctionalIdentifier()` method in the `Actor` class no longer
  returns a string, but returns an `InverseFunctionalIdentifier` instance
  instead

* A new class `InverseFunctionalIdentifier` was introduced to reflect the
  inverse functional identifier of an actor. It reflects the fact that an IRI
  must only contain exactly one property of `mbox`, `mboxsha1sum`, `openid`,
  and `account` by providing four factory methods to obtain an IRI instance:

  * `withMbox()`

  * `withMboxSha1Sum()`

  * `withOpenId()`

  * `withAccount()`

  You now need to pass an `InverseFunctionalIdentifier` when creating an actor
  or group.

  Before:

  ```php
  use Xabbuh\XApi\Model\Agent;
  use Xabbuh\XApi\Model\Group;

  $agent = new Agent(
      'mailto:christian@example.com',
      null,
      null,
      null,
      'Christian'
  );
  $group = new Group(
      null,
      null,
      null,
      new Account('GroupAccount', 'http://example.com/homePage'),
      'Example Group'
  );
  ```

  After:

  ```php
  use Xabbuh\XApi\Model\Agent;
  use Xabbuh\XApi\Model\Group;
  use Xabbuh\XApi\Model\InverseFunctionalIdentifier;

  $agent = new Agent(
      InverseFunctionalIdentifier::withMbox('mailto:christian@example.com'),
      'Christian'
  );
  $group = new Group(
      InverseFunctionalIdentifier::withAccount(
          new Account('GroupAccount', 'http://example.com/homePage')
      ),
      'Example Group'
  );
  ```

* The `Statement` class is now marked as final. This means that you can no
  longer extend it.
