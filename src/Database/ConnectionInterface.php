<?php
/**
 * Created by PhpStorm.
 * User: lilian
 * Date: 10/02/18
 * Time: 15:32
 */

namespace Eerison\Agenda\Database;


interface ConnectionInterface
{
    public function __invoke() : \PDO;
}