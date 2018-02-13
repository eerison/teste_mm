<?php
namespace Eerison\Routing;


use Eerison\Agenda\DependencyInjection\ContatosDependencyInjection;
use Eerison\Agenda\Factory\ContatosControllerFactory;

class Routing
{
    private $collections = [];

    public function __construct()
    {
        $this->collections = [

            #contatos
            '' => [
                'GET' => dirname(__DIR__) . '/src/View/contatos/index.html'
            ],

            #api
            '/api/contatos' => [
                'GET' => function($params) { ContatosControllerFactory::call()->index(); },
                'POST' => function($params) { ContatosControllerFactory::call()->add(); },
                'PUT'  => function($params) { ContatosDependencyInjection::editControoler(); },
                'DELETE'  => function($params) { ContatosDependencyInjection::deleteController($params['id']); },
            ],

        ];
    }

    public function loadFile()
    {
        $load = $this->collections[$_SERVER['PATH_INFO']][$_SERVER['REQUEST_METHOD']];

        if(!$load)
            die('pagina não encontrada!');

        //caso seja uma função vai executar
        if(is_callable($load))
            return $load($_GET);

        if(!file_exists($load))
            die('arquivo não encontrado!');

        include $load;
    }


}