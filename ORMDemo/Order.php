<?php

namespace ORMDemo;

use Doctrine\ORM\Mapping as ORM;

/**
 * ORMDemo\Order
 */
class Order
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var integer $value
     */
    private $value;

    /**
     * @var ORMDemo\Company
     */
    private $company;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param integer $value
     * @return Order
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set company
     *
     * @param ORMDemo\Company $company
     * @return Order
     */
    public function setCompany(\ORMDemo\Company $company = null)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * Get company
     *
     * @return ORMDemo\Company 
     */
    public function getCompany()
    {
        return $this->company;
    }
}