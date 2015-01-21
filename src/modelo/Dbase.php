<?php
    include_once("../ctrl/security.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBase
 *
 * @author Agustin
 */
class DBase 
{
    //put your code here
    private $link;
    private $server;			
    private $dbname;
    private $username;
    private $password;
    static private $instance;
    private function __construct()
    {
        // **** PRODUCCION ****
        //$this->server = 'sql200.xtreemhost.com';
        //$this->dbname   = 'xth_8767702_inmosys_db';
       // $this->username = 'xth_8767702';
	//$this->password = 'Inmosys';

        // **** PRUEBAS ****
        //$this->server = 'localhost';
        //$this->dbname   = 'xth_8767702_inmosys_db';
        //$this->username = 'root';
        //$this->password = '';

        $this->server   = 'localhost:3306';
        $this->dbname   = 'xth_8767702_inmosys_db';
        $this->username = 'admin';
        $this->password = '1234';
        $this->link = null;

    }
    public static function getInstance()
    {
        if(self::$instance==NULL)
        {
            self::$instance = new DBase();
        }
        return self::$instance;
    }

    public function __toString()
    {
        ;
    }

    public function connectTo()
    {
	$this->link = mysql_connect($this->server, $this->username, $this->password);
        if($this->link==false)
            return false;
        else
        { 
            if(!mysql_select_db($this->dbname, $this->link))
                return false;
            else      
                return true;
        }
    }

    public function executeQry ($qry, &$num)
    {
        $result = mysql_query($qry, $this->link);
        if(!$result)
            $num = -1;
        else
             $num=mysql_affected_rows();
        return $result;        
        
    }

    public function fetchField()
    {
        return mysql_fetch_field($result);
    }

    public function _fetch_assoc($result)
    {
        return mysql_fetch_assoc($result);
    }

    public function getResult($result, $i)
    {
        return mysql_result($result, $i);
    }

    public function close()
    {
        return mysql_close();
    }

    public function getConf()
    {
        return array($this->server, $this->dbname, $this->username, $this->password);
    }

    public function getDBName()
    {
        return $this->dbname;
    }
}

?>
