<?php
namespace Eerison\Tests;

use Eerison\Agenda\Database\ConnectionMysql;
use Eerison\Agenda\Entity\Contato;
use Eerison\Agenda\Model\ContatosModel;
use PHPUnit\Framework\TestCase;

class ContatosTest extends TestCase
{
    public function testInsertContato()
    {
        $this->assertTrue(true);
    }

    public function testDelete()
    {
        $mod = new ContatosModel(new ConnectionMysql());
        var_dump($mod->findById(1));
    }
}