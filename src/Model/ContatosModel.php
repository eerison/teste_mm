<?php
namespace Eerison\Agenda\Model;

use Eerison\Agenda\Database\ConnectionInterface;
use Eerison\Agenda\Entity\Contato;

class ContatosModel
{
    private $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection();
    }

    public function findAll(bool $array = false)
    {
        $stmt = $this->connection->query('SELECT * FROM contato');

        if($array)
            return $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, Contato::class);
    }

    public function findById(int $id) : Contato
    {
        $stmt = $this->connection->prepare('SELECT * FROM contato WHERE id=:id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchObject(Contato::class);

        return $result;
    }

    public function save(Contato $contato) : Contato
    {
        $sql = 'INSERT INTO contato (name, phone, address) VALUES (:name, :phone, :address)';

        if($contato->getId())
            $sql = 'UPDATE contato SET name=:name, phone=:phone, address=:address WHERE id=:id';

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':name', $contato->getName());
            $stmt->bindValue(':phone', $contato->getPhone());
            $stmt->bindValue(':address', $contato->getAddress());

            if($contato->getId())
                $stmt->bindValue(':id', $contato->getId());

            $this->connection->beginTransaction();
            $stmt->execute();

            if(!$contato->getId())
                $contato->setId($this->connection->lastInsertId());

            $this->connection->commit();

            return $contato;

        } catch (\PDOException $exception) {
            $this->connection->rollBack();
            throw $exception;
        }

    }

    public function delete(Contato $contato) : bool
    {
        $stmt = $this->connection->prepare('DELETE FROM contato WHERE id=:id');
        $stmt->bindValue(':id', $contato->getId());
        return $stmt->execute();

    }
}