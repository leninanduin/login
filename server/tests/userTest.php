<?php
/**
 * UserTest
 *
 * @group group
 */

class UserTest extends \PHPUnit_Framework_TestCase
{
  public function testUserConstructor() {

    $this->setExpectedException('Exception', 'User information is required.');
    $user = new User();

    $user = new User(['id' => 1, 'email' => 'me@me.com', 'password' => 'notasecurepassword']);
    $this->assertEquals(1, $user->id);
  }

  public function testPasswordHashing() {
    $data = ['id' => 1, 'email' => 'me@me.com', 'password' => 'notasecurepassword'];
    $user = new User($data, 0);
    $user->passwordHashing();

    $this->assertNotEquals($data['password'], $user->password);
    $this->assertEquals(60, strlen($user->password));
  }
}


?>