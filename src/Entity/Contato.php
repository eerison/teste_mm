<?php
/**
 * Created by PhpStorm.
 * User: lilian
 * Date: 10/02/18
 * Time: 10:46
 */

namespace Eerison\Agenda\Entity;


class Contato
{
    private $id;
    private $name;
    private $phone;
    private $address;

    /**
     * @return int
     */
    public function getId() :?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Contato
     */
    public function setId(int $id) : Contato
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Contato
     */
    public function setName(string $name) : Contato
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone() :?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Contato
     */
    public function setPhone(?string $phone) : Contato
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress() :?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Contato
     */
    public function setAddress(?string $address) : Contato
    {
        $this->address = $address;
        return $this;
    }
}