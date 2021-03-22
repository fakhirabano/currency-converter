<?php
namespace Api\models;

class Converter {
    private $conn;
    private $table = "currency_conversion";

    public $id;
    public $src_currency;
    public $tar_currency;
    public $amount;
    public $result;

    public function __construct($db = null) {
      $this->conn = $db;  
    }

    function convert() {

        $endpoint = 'latest';
        $access_key = '60b2e1b04ff6c13eba690df5e90faefa';

        $from = $this->src_currency;
        $to = $this->tar_currency;
        $amount = $this->amount;
        
        $init_var = 'http://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'&from='.$from.'&to='.$to.'&amount='.$amount.'';
        $ch = curl_init($init_var);   

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);

        curl_close($ch);

        $exchangeRate = json_decode($json, true);
        $src_rate = $exchangeRate['rates'][$from];
        $target_rate = $exchangeRate['rates'][$to];
        $result = $target_rate/$src_rate * $amount;

        return $result;
       
    }

    function insert($result) {
        $sql_insert = "INSERT INTO $this->table (src_currency, tar_currency, amount, result) VALUES ('$this->src_currency', '$this->tar_currency', '$this->amount', '$result')";  
        return $this->conn->query($sql_insert);


        if ($this->conn->query($sql_insert) === true) {
          return true;
        } else {
          return "Error: " . $sql_insert . "<br>" . $conn->error;
        }

    }

}


?>