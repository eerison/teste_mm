<?php

namespace Eerison\Agenda\Factory;

use Eerison\Agenda\Controller\ContatosController;

class ContatosControllerFactory
{
    public static function call()
    {
        return new ContatosController(ContatosModelFactory::call());
    }


}