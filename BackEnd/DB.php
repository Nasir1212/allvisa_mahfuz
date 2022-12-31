<?php
Class DB {

    public $CON;

    const DB_NAME  = 'db_creating_page';
    const HOST_NAME = '127.0.0.1';
    const USER_NAME = 'root';
    const PASSWORD = '';

    public function __construct(){
        $this->connection();
    }
    private function connection(){

        try {
           $this->CON = new PDO("mysql:host=".self::HOST_NAME.";dbname=".self::DB_NAME,self::USER_NAME,self::PASSWORD);
           $this->CON->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
       
        } catch (PDOException $e) {
            die('Connectionn Failed : ' . $e->getMessage());
        }


    }


}

$obj = new DB();
