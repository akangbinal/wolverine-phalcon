<?php

class ProductPrice extends \Phalcon\Mvc\Model
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
    protected $price;

    /**
     *
     * @var integer
     */
    protected $special_price;

    /**
     *
     * @var string
     */
    protected $special_price_from_date;

    /**
     *
     * @var string
     */
    protected $special_price_to_date;

    /**
     *
     * @var integer
     */
    protected $cost;

    /**
     *
     * @var integer
     */
    protected $expected_cost;

    /**
     *
     * @var integer
     */
    protected $event_cost;

    /**
     *
     * @var string
     */
    protected $event_cost_from_date;

    /**
     *
     * @var string
     */
    protected $event_cost_to_date;

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
     * Method to set the value of field price
     *
     * @param integer $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Method to set the value of field special_price
     *
     * @param integer $special_price
     * @return $this
     */
    public function setSpecialPrice($special_price)
    {
        $this->special_price = $special_price;

        return $this;
    }

    /**
     * Method to set the value of field special_price_from_date
     *
     * @param string $special_price_from_date
     * @return $this
     */
    public function setSpecialPriceFromDate($special_price_from_date)
    {
        $this->special_price_from_date = $special_price_from_date;

        return $this;
    }

    /**
     * Method to set the value of field special_price_to_date
     *
     * @param string $special_price_to_date
     * @return $this
     */
    public function setSpecialPriceToDate($special_price_to_date)
    {
        $this->special_price_to_date = $special_price_to_date;

        return $this;
    }

    /**
     * Method to set the value of field cost
     *
     * @param integer $cost
     * @return $this
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Method to set the value of field expected_cost
     *
     * @param integer $expected_cost
     * @return $this
     */
    public function setExpectedCost($expected_cost)
    {
        $this->expected_cost = $expected_cost;

        return $this;
    }

    /**
     * Method to set the value of field event_cost
     *
     * @param integer $event_cost
     * @return $this
     */
    public function setEventCost($event_cost)
    {
        $this->event_cost = $event_cost;

        return $this;
    }

    /**
     * Method to set the value of field event_cost_from_date
     *
     * @param string $event_cost_from_date
     * @return $this
     */
    public function setEventCostFromDate($event_cost_from_date)
    {
        $this->event_cost_from_date = $event_cost_from_date;

        return $this;
    }

    /**
     * Method to set the value of field event_cost_to_date
     *
     * @param string $event_cost_to_date
     * @return $this
     */
    public function setEventCostToDate($event_cost_to_date)
    {
        $this->event_cost_to_date = $event_cost_to_date;

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
     * Returns the value of field price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the value of field special_price
     *
     * @return integer
     */
    public function getSpecialPrice()
    {
        return $this->special_price;
    }

    /**
     * Returns the value of field special_price_from_date
     *
     * @return string
     */
    public function getSpecialPriceFromDate()
    {
        return $this->special_price_from_date;
    }

    /**
     * Returns the value of field special_price_to_date
     *
     * @return string
     */
    public function getSpecialPriceToDate()
    {
        return $this->special_price_to_date;
    }

    /**
     * Returns the value of field cost
     *
     * @return integer
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Returns the value of field expected_cost
     *
     * @return integer
     */
    public function getExpectedCost()
    {
        return $this->expected_cost;
    }

    /**
     * Returns the value of field event_cost
     *
     * @return integer
     */
    public function getEventCost()
    {
        return $this->event_cost;
    }

    /**
     * Returns the value of field event_cost_from_date
     *
     * @return string
     */
    public function getEventCostFromDate()
    {
        return $this->event_cost_from_date;
    }

    /**
     * Returns the value of field event_cost_to_date
     *
     * @return string
     */
    public function getEventCostToDate()
    {
        return $this->event_cost_to_date;
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

}
