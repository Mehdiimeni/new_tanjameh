<?php

require_once dirname(__FILE__,2) . "/interfaces/DBConnectionInterface.php";

final class MySQLConnection implements DBConnectionInterface
{

    public function __construct(array $array)
    {
        $this->Host = base64_decode(base64_decode($array['Host']));
        $this->Datebase = base64_decode(base64_decode($array['Database']));
        $this->User = base64_decode(base64_decode($array['User']));
        $this->Password = base64_decode(base64_decode($array['Password']));
        $this->IP = base64_decode(base64_decode($array['IP']));
        $this->Port = base64_decode(base64_decode($array['Port']));
        $this->PConn = '';

    }

    public function connect()
    {

        try {
            strtolower($this->Password) == 'null' ? $this->Password = '' : $this->Password;
           // $this->PConn = new PDO('mysql:host='.$this->Host.';dbname='.$this->Datebase.';charset=utf8', $this->User, $this->Password);
            $this->PConn = new PDO('mysql:host=localhost;dbname=new_tanjameh;charset=utf8', 'root', '');
            $this->PConn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );

        } catch (\PDOException $e) {
            throw new\PDOException($e->getMessage(), ( int )$e->getCode());

        }
    }

    public function getConn()
    {
        if ($this->PConn == null) $this->connect();
        return $this->PConn;
    }


}
