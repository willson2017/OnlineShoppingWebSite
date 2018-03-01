<?php

class DBFunctions{
    const dbhost    = "localhost";
    const dbname    = "hats1";
    const username  = "root";
    const passwd    = "";

    private static $_instance = null;
    private $con = null;

    private function __construct()
    {
        $con = new mysqli (self::dbhost, self::username, self::passwd, self::dbname);
        if ($con->connect_error){
            throw new Exception("Cannot connect to the my sql server, the reason is : ". $con->connect_error);
        }
        $con->set_charset('utf-8');
        $this->con = $con;
    }

    public function __destruct()
    {
        if( $this->con instanceof mysqli)
        {
            $this->con->close();
        }
    }

    public static function GetDBInstance()
    {
        if (! self::$_instance instanceof DBFunctions) {
            self::$_instance = new DBFunctions();
        }
        return self::$_instance;
    }

    public function GetQueryResult($statement)
    {
        mysqli_select_db($this->con,self::dbname);
        $result = mysqli_query($this->con, $statement);
        return $result;
    }

    public function DeleteQuery($tablename, $column, $value)
    {
        mysqli_select_db($this->con,self::dbname);
        $strSql = "delete from $tablename where $column = $value";
        $result = mysqli_query($this->con, $strSql);
        return $result;
    }
}

?>