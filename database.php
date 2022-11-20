<?php
class database
{
    private $host;
    private $dbName;
    private $dbUsername;
    private $dbPassword;
    
    protected function connect ()
    {
        $this->host='127.0.0.1';
        $this->dbName='todo';
        $this->dbUsername='root';
        $this->dbPassword='Cts@1234';
        $sqlConnect = new mysqli ($this->host,$this->dbUsername,$this->dbPassword,$this->dbName);
        return $sqlConnect;
        {
            die('Connection Failed '.mysqli_connect_error());
        }
    }
    
}





?>