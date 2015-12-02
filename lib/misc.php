<?php
  function pr($a) {
    echo '<pre>';
    print_r($a);
    echo '</pre>';
  }

  function getVisitorCity($ip) {
    $details = json_decode(file_get_contents("http://ipinfo.io/json"));
    return $details->city;
  }

  class Result {
    public $msg;
    public $status;

    public function render() {
      return json_encode($this);
    }
  }
?>