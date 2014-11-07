<?php

class Customers extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $first_name;

    /**
     *
     * @var string
     */
    protected $last_name;

    /**
     *
     * @var string
     */
    protected $term_condition_aggrement_date;

    /**
     *
     * @var string
     */
    protected $term_condition_aggrement_ip;

    /**
     *
     * @var string
     */
    protected $last_login;

    /**
     *
     * @var string
     */
    protected $last_activity;

    /**
     *
     * @var string
     */
    protected $birth_date;

    /**
     *
     * @var integer
     */
    protected $status;

    /**
     *
     * @var string
     */
    protected $note;

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
     * Method to set the value of field first_name
     *
     * @param string $first_name
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Method to set the value of field last_name
     *
     * @param string $last_name
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Method to set the value of field term_condition_aggrement_date
     *
     * @param string $term_condition_aggrement_date
     * @return $this
     */
    public function setTermConditionAggrementDate($term_condition_aggrement_date)
    {
        $this->term_condition_aggrement_date = $term_condition_aggrement_date;

        return $this;
    }

    /**
     * Method to set the value of field term_condition_aggrement_ip
     *
     * @param string $term_condition_aggrement_ip
     * @return $this
     */
    public function setTermConditionAggrementIp($term_condition_aggrement_ip)
    {
        $this->term_condition_aggrement_ip = $term_condition_aggrement_ip;

        return $this;
    }

    /**
     * Method to set the value of field last_login
     *
     * @param string $last_login
     * @return $this
     */
    public function setLastLogin($last_login)
    {
        $this->last_login = $last_login;

        return $this;
    }

    /**
     * Method to set the value of field last_activity
     *
     * @param string $last_activity
     * @return $this
     */
    public function setLastActivity($last_activity)
    {
        $this->last_activity = $last_activity;

        return $this;
    }

    /**
     * Method to set the value of field birth_date
     *
     * @param string $birth_date
     * @return $this
     */
    public function setBirthDate($birth_date)
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    /**
     * Method to set the value of field status
     *
     * @param integer $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Method to set the value of field note
     *
     * @param string $note
     * @return $this
     */
    public function setNote($note)
    {
        $this->note = $note;

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
     * Returns the value of field first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Returns the value of field last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Returns the value of field term_condition_aggrement_date
     *
     * @return string
     */
    public function getTermConditionAggrementDate()
    {
        return $this->term_condition_aggrement_date;
    }

    /**
     * Returns the value of field term_condition_aggrement_ip
     *
     * @return string
     */
    public function getTermConditionAggrementIp()
    {
        return $this->term_condition_aggrement_ip;
    }

    /**
     * Returns the value of field last_login
     *
     * @return string
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * Returns the value of field last_activity
     *
     * @return string
     */
    public function getLastActivity()
    {
        return $this->last_activity;
    }

    /**
     * Returns the value of field birth_date
     *
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * Returns the value of field status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns the value of field note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'AppCustomer', 'customer_id', NULL);
        $this->hasMany('id', 'Credentials', 'customer_id', NULL);
        $this->hasMany('id', 'CustomerAddresses', 'customer_id', NULL);
        $this->hasMany('id', 'CustomerGroups', 'customer_id', NULL);
        $this->hasMany('id', 'Email', 'customer_id', NULL);
    }

}
