<?php
namespace Eerison\Agenda\Controller;

use Eerison\Agenda\Entity\Contato;
use Eerison\Agenda\Model\ContatosModel;
use Eerison\Agenda\Utils\ResponseJson;

class ContatosController
{
    private $contatosModel;

    public function __construct(ContatosModel $contatosModel)
    {
        $this->contatosModel = $contatosModel;
    }

    public function index()
    {
        ResponseJson::responseJson($this->contatosModel->findAll(true));
    }

    public function add()
    {
        try {
            $params = (array) json_decode( file_get_contents('php://input') );

            $contato = new Contato();
            $contato
                ->setName($params['name'])
                ->setPhone($params['phone'])
                ->setAddress($params['address'])
            ;

            $this->contatosModel->save($contato);

            $contatoArray = [
                'id' => $contato->getId(),
                'name' => $contato->getName(),
                'phone' => $contato->getPhone(),
                'address' => $contato->getAddress(),
            ];

            ResponseJson::responseJson($contatoArray);

        } catch (\Throwable $exception) {
            ResponseJson::responseJson($exception->getMessage(), 400);
        }
    }

    public function edit(Contato $contato)
    {
        try {
            $result = $this->contatosModel->save($contato);

            $resultArray = [
                'id' => $result->getId(),
                'name' => $result->getName(),
                'Phone' => $result->getPhone(),
                'address' => $result->getAddress(),
            ];

            ResponseJson::responseJson($resultArray);
        } catch (\Throwable $exception) {
            ResponseJson::responseJson($exception->getMessage(), 400);
        }
    }

    public function delete(Contato $contato)
    {
        $this->contatosModel->delete($contato);
        ResponseJson::responseJson('registro deletado!');
    }
}