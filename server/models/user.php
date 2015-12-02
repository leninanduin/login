<?php

class User
{
    private static $optional_values = ['phone', 'id', 'registered_date'];
    private static $table = 'users';
    private $db;
    public $err;

    public $id;
    public $full_name;
    public $email;
    private $password;
    public $phone;
    public $address_line_1;
    public $city;
    public $state_or_region;
    public $zip;
    public $country;
    public $lat;
    public $lng;
    public $registered_date;

    public function __construct($parameters = array()) {
        foreach($parameters as $key => $value) {
            $value = trim($value);
            if ($value == '' && !in_array($key, $this::$optional_values)){
                throw new Exception("$key is a required value for a new user");
            }
            $this->$key = $value;
        }

        // password hashing
        $this->passwordHashing();

        //init DB
        $this->db = new PDO("mysql:host=localhost;dbname=login;charset=utf8", 'dbuser', 'notasecurepassword');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function passwordHashing() {
        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        $this->password = password_hash($this->password, PASSWORD_BCRYPT, $options);
    }

    public function save() {

        $stmt = $this->db->prepare('INSERT into '.$this::$table.'(full_name, email, password, phone, address_line_1, city, state_or_region, zip, country, lat, lng) VALUES (:full_name, :email, :password, :phone, :address_line_1, :city, :state_or_region, :zip, :country, :lat, :lng)');
        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':address_line_1', $this->address_line_1);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':state_or_region', $this->state_or_region);
        $stmt->bindParam(':zip', $this->zip);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':lat', $this->lat);
        $stmt->bindParam(':lng', $this->lng);

        // verify email
        if ($this->isEmailRegistered()){
            $this->err = "The email <b>$this->email</b> is already registered, please try another one.";
            throw new Exception($this->err);
        }

        try {
            $stmt->execute();
            return $this->loadByEmailAndPass($this);
        } catch(PDOException $e) {
            return $this->err = $e->getMessage();
        }
    }

    public function isEmailRegistered() {
        $stmt = $this->db->prepare('SELECT count(id) as n FROM '.$this::$table.' WHERE email=:email');
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $r = $stmt->fetch(PDO::FETCH_OBJ);

        return $r->n;

    }

    public function loadByEmailAndPass($u) {
        $stmt = $this->db->prepare('SELECT id, full_name, email, phone, address_line_1, city, state_or_region, zip, country, lat, lng, registered_date FROM '.$this::$table.' WHERE email=:email AND password=:password LIMIT 1');
        $stmt->bindParam(':email', $u->email);
        $stmt->bindParam(':password', $u->password);
        $stmt->setFetchMode(PDO::FETCH_INTO, $this);

        try {
            $stmt->execute();
            return $stmt->fetch();
        } catch(PDOException $e) {
            return $this->err = $e->getMessage();
        }
    }

}

?>