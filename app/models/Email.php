<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class Email extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $customer_id;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var integer
     */
    protected $verify;

    /**
     *
     * @var string
     */
    protected $verify_date;

    /**
     *
     * @var integer
     */
    protected $subscribe;

    /**
     *
     * @var string
     */
    protected $subscribe_date;

    /**
     *
     * @var string
     */
    protected $ips;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field customer_id
     *
     * @param integer $customer_id
     * @return $this
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method to set the value of field verify
     *
     * @param integer $verify
     * @return $this
     */
    public function setVerify($verify)
    {
        $this->verify = $verify;

        return $this;
    }

    /**
     * Method to set the value of field verify_date
     *
     * @param string $verify_date
     * @return $this
     */
    public function setVerifyDate($verify_date)
    {
        $this->verify_date = $verify_date;

        return $this;
    }

    /**
     * Method to set the value of field subscribe
     *
     * @param integer $subscribe
     * @return $this
     */
    public function setSubscribe($subscribe)
    {
        $this->subscribe = $subscribe;

        return $this;
    }

    /**
     * Method to set the value of field subscribe_date
     *
     * @param string $subscribe_date
     * @return $this
     */
    public function setSubscribeDate($subscribe_date)
    {
        $this->subscribe_date = $subscribe_date;

        return $this;
    }

    /**
     * Method to set the value of field ips
     *
     * @param string $ips
     * @return $this
     */
    public function setIps($ips)
    {
        $this->ips = $ips;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field customer_id
     *
     * @return integer
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field verify
     *
     * @return integer
     */
    public function getVerify()
    {
        return $this->verify;
    }

    /**
     * Returns the value of field verify_date
     *
     * @return string
     */
    public function getVerifyDate()
    {
        return $this->verify_date;
    }

    /**
     * Returns the value of field subscribe
     *
     * @return integer
     */
    public function getSubscribe()
    {
        return $this->subscribe;
    }

    /**
     * Returns the value of field subscribe_date
     *
     * @return string
     */
    public function getSubscribeDate()
    {
        return $this->subscribe_date;
    }

    /**
     * Returns the value of field ips
     *
     * @return string
     */
    public function getIps()
    {
        return $this->ips;
    }

    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('customer_id', 'Customers', 'id', array('foreignKey' => true));
    }

}
