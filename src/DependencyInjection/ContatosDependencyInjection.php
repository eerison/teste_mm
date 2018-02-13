<?php
/**
 * Created by PhpStorm.
 * User: lilian
 * Date: 11/02/18
 * Time: 08:41
 */

namespace Eerison\Agenda\DependencyInjection;


use Eerison\Agenda\Entity\Contato;
use Eerison\Agenda\Factory\ContatosControllerFactory;
use Eerison\Agenda\Factory\ContatosModelFactory;
use Eerison\Agenda\Utils\ResponseJson;

class ContatosDependencyInjection
{
    public static function findByIdModel(int $id) : Contato
    {
        $model = ContatosModelFactory::call();
        return $model->findById($id);
    }

    public static function editControoler()
    {
        try {
            $params = (array) json_decode( file_get_contents('php://input') );

            $contato = self::findByIdModel($params['id']);
            $contato->setName($params['name']);
            $contato->setPhone($params['phone']);
            $contato->setAddress($params['address']);

            return ContatosControllerFactory::call()->edit($contato);
        } catch (\PDOException $exception) {
            ResponseJson::responseJson($exception->getMessage(), 400);
        } catch (\Throwable $exception) {
            ResponseJson::responseJson('erro ao buscar contato!', 400);
        }


    }

    public static function deleteController(int $id)
    {
        try {
            $contato = self::findByIdModel($id);
            return ContatosControllerFactory::call()->delete($contato);
        } catch (\Throwable $exception) {
            ResponseJson::responseJson('erro ao deletar registro!', 400);
        }
    }
}