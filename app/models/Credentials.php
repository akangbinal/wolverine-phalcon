<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class Credentials extends \Phalcon\Mvc\Model
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
     * @var string
     */
    protected $password;

    /**
     *
     * @var string
     */
    protected $salt;

    /**
     *
     * @var integer
     */
    protected $type;

    /**
     *
     * @var string
     */
    protected $token;

    /**
     *
     * @var string
     */
    protected $token_expired_date;

    /**
     *
     * @var integer
     */
    protected $force_change_password;

    /**
     *
     * @var string
     */
    protected $created_date;

    /**
     *
     * @var string
     */
    protected $last_updated_date;

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
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Method to set the value of field salt
     *
     * @param string $salt
     * @return $this
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Method to set the value of field type
     *
     * @param integer $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Method to set the value of field token
     *
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Method to set the value of field token_expired_date
     *
     * @param string $token_expired_date
     * @return $this
     */
    public function setTokenExpiredDate($token_expired_date)
    {
        $this->token_expired_date = $token_expired_date;

        return $this;
    }

    /**
     * Method to set the value of field force_change_password
     *
     * @param integer $force_change_password
     * @return $this
     */
    public function setForceChangePassword($force_change_password)
    {
        $this->force_change_password = $force_change_password;

        return $this;
    }

    /**
     * Method to set the value of field created_date
     *
     * @param string $created_date
     * @return $this
     */
    public function setCreatedDate($created_date)
    {
        $this->created_date = $created_date;

        return $this;
    }

    /**
     * Method to set the value of field last_updated_date
     *
     * @param string $last_updated_date
     * @return $this
     */
    public function setLastUpdatedDate($last_updated_date)
    {
        $this->last_updated_date = $last_updated_date;

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
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the value of field salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Returns the value of field type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the value of field token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Returns the value of field token_expired_date
     *
     * @return string
     */
    public function getTokenExpiredDate()
    {
        return $this->token_expired_date;
    }

    /**
     * Returns the value of field force_change_password
     *
     * @return integer
     */
    public function getForceChangePassword()
    {
        return $this->force_change_password;
    }

    /**
     * Returns the value of field created_date
     *
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->created_date;
    }

    /**
     * Returns the value of field last_updated_date
     *
     * @return string
     */
    public function getLastUpdatedDate()
    {
        return $this->last_updated_date;
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
