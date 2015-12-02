<?php
/**
 * AuthTokenTest
 *
 * @group group
 */

class AuthTokenTest extends \PHPUnit_Framework_TestCase
{
    public function testTokenConstructor() {
      $uid = 10;
      $token = new AuthToken($uid, 0);
      $this->assertEquals($uid, $token->user_id);
      $this->assertEquals('', $token->token);
    }

    public function testIsValid() {
      $uid = 10;
      $token = new AuthToken($uid, 0);
      $token->valid_until = date('Y-m-d');
      $this->assertFalse($token->isValid());

      $date = strtotime("+1 day");
      $token->valid_until = date('Y-m-d h:m:s', $date);
      $this->assertTrue($token->isValid());
    }
}


?>