<?php
/**
 * Created by PhpStorm.
 * User: lilian
 * Date: 10/02/18
 * Time: 15:20
 */

namespace Eerison\Agenda\Factory;


use Eerison\Agenda\Database\ConnectionMysql;
use Eerison\Agenda\Model\ContatosModel;

class ContatosModelFactory
{
    public static function call() : ContatosModel
    {
        return new ContatosModel(new ConnectionMysql);
    }
}