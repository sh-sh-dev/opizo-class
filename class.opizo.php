<?php

class Opizo {
    public $username = null;
    public $fix_cURL = false;
    private $opizo = 'http://opizo.com/webservice/shrink';
    public function __construct($username) {
        $this->username = $username;
    }
    public function Shorten($url) {
        if ($this->fix_cURL) {
            $data = array(
                'username' => $this->username,
                'url' => $url,
            );
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencodedrn",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context  = stream_context_create($options);
            $result = file_get_contents($this->opizo, false, $context);
            return $result;
        }
        else {
            $curl = curl_init($this->opizo);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function getUsername() {
        return $this->username;
    }
    public function set_fix_cURL($fao) {
        $this->fix_cURL = $fao;
    }
    public function get_fix_cURL() {
        return $this->fix_cURL;
    }
}
?>
