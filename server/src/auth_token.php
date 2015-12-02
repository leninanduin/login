<?php
class AuthToken
{
  private static $table = 'tokens';
  private $db;

  public $token;
  public $valid_until;
  public $always_valid;
  public $user_id;

  public function __construct($uid = 0, $useDb = 1) {
    $this->user_id = $uid;

    if ($useDb) {
      //init DB
      $this->db = new PDO("mysql:host=localhost;dbname=login;charset=utf8", 'dbuser', 'notasecurepassword');
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

  }

  public function save($always_valid) {
    // if there is a valid token, return it
    $this->loadByUserId($this->user_id);
    if ($this->token !== '' && $this->isValid()) {
      return $this;
    }

    $stmt = $this->db->prepare('INSERT into '.$this::$table.'(token, valid_until, always_valid, user_id) VALUES (:token, :valid_until, :always_valid, :user_id)');

    if ($always_valid) {
      $this->always_valid = $always_valid;
    } else {
      //the token will be valid for one day
      $date = strtotime("+1 day");
      $this->valid_until = date('Y-m-d h:m:s', $date);
    }

    $this->token = bin2hex(openssl_random_pseudo_bytes(25));

    $stmt->bindParam(':token', $this->token);
    $stmt->bindParam(':valid_until', $this->valid_until);
    $stmt->bindParam(':always_valid', $this->always_valid);
    $stmt->bindParam(':user_id', $this->user_id);

    try {
      $stmt->execute();
      return $this;
    } catch(PDOException $e) {
      return $e->getMessage();
    }
  }

  public function loadByToken($token) {
    $stmt = $this->db->prepare('SELECT * FROM '.$this::$table.' WHERE token=:token LIMIT 1');
    $stmt->bindParam(':token', $token);
    $stmt->setFetchMode(PDO::FETCH_INTO, $this);
    try {
      $stmt->execute();
      return $stmt->fetch();
    } catch(PDOException $e) {
      return $e->getMessage();
    }
  }

  public function loadByUserId($uid) {
    $stmt = $this->db->prepare('SELECT * FROM '.$this::$table.' WHERE user_id=:user_id LIMIT 1');
    $stmt->bindParam(':user_id', $uid);
    $stmt->setFetchMode(PDO::FETCH_INTO, $this);
    try {
      $stmt->execute();
      return $stmt->fetch();
    } catch(PDOException $e) {
      return $e->getMessage();
    }
  }

  public function isValid() {
    if ($this->always_valid) {
      return true;
    } else {
      $today_time = strtotime(date("Y-m-d h:m:s"));
      $expire_time = strtotime($this->valid_until);
      return ($expire_time < $today_time) ? false : true;
    }
  }
}

?>