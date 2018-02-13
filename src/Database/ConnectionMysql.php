<?php
namespace Eerison\Agenda\Database;

use Symfony\Component\Yaml\Yaml;

class ConnectionMysql implements ConnectionInterface
{
    private $connection;

    private function Connection() : \PDO
    {
        if(!$this->connection) {
            ['drive' => $drive, 'host' => $host, 'dbname' => $dbname, 'user' => $user, 'password' => $password]
                = Yaml::parseFile('config/database.yml')['database'];

            $this->connection = new \PDO("$drive:host=$host;dbname=$dbname", $user, $password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }


        return $this->connection;
    }

    public function __invoke() : \PDO
    {
        return $this->Connection();
    }
}