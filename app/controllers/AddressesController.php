<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class AddressesController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for addresses
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Addresses", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $addresses = Addresses::find($parameters);
        if (count($addresses) == 0) {
            $this->flash->notice("The search did not find any addresses");

            return $this->dispatcher->forward(array(
                "controller" => "addresses",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $addresses,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displayes the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a addresse
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $addresse = Addresses::findFirstByid($id);
            if (!$addresse) {
                $this->flash->error("addresse was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "addresses",
                    "action" => "index"
                ));
            }

            $this->view->id = $addresse->id;

            $this->tag->setDefault("id", $addresse->id);
            $this->tag->setDefault("customer_id", $addresse->customer_id);
            $this->tag->setDefault("type", $addresse->type);
            $this->tag->setDefault("address", $addresse->address);
            $this->tag->setDefault("additional_info", $addresse->additional_info);
            $this->tag->setDefault("zipcode", $addresse->zipcode);
            $this->tag->setDefault("rural", $addresse->rural);
            $this->tag->setDefault("district", $addresse->district);
            $this->tag->setDefault("city", $addresse->city);
            $this->tag->setDefault("province", $addresse->province);
            $this->tag->setDefault("country", $addresse->country);
            $this->tag->setDefault("phone", $addresse->phone);
            $this->tag->setDefault("mobile", $addresse->mobile);
            $this->tag->setDefault("shipping", $addresse->shipping);
            $this->tag->setDefault("billing", $addresse->billing);
            $this->tag->setDefault("created_date", $addresse->created_date);
            $this->tag->setDefault("last_updated_date", $addresse->last_updated_date);
            
        }
    }

    /**
     * Creates a new addresse
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "addresses",
                "action" => "index"
            ));
        }

        $addresse = new Addresses();

        $addresse->customer_id = $this->request->getPost("customer_id");
        $addresse->type = $this->request->getPost("type");
        $addresse->address = $this->request->getPost("address");
        $addresse->additional_info = $this->request->getPost("additional_info");
        $addresse->zipcode = $this->request->getPost("zipcode");
        $addresse->rural = $this->request->getPost("rural");
        $addresse->district = $this->request->getPost("district");
        $addresse->city = $this->request->getPost("city");
        $addresse->province = $this->request->getPost("province");
        $addresse->country = $this->request->getPost("country");
        $addresse->phone = $this->request->getPost("phone");
        $addresse->mobile = $this->request->getPost("mobile");
        $addresse->shipping = $this->request->getPost("shipping");
        $addresse->billing = $this->request->getPost("billing");
        $addresse->created_date = $this->request->getPost("created_date");
        $addresse->last_updated_date = $this->request->getPost("last_updated_date");
        

        if (!$addresse->save()) {
            foreach ($addresse->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "addresses",
                "action" => "new"
            ));
        }

        $this->flash->success("addresse was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "addresses",
            "action" => "index"
        ));

    }

    /**
     * Saves a addresse edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "addresses",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $addresse = Addresses::findFirstByid($id);
        if (!$addresse) {
            $this->flash->error("addresse does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "addresses",
                "action" => "index"
            ));
        }

        $addresse->customer_id = $this->request->getPost("customer_id");
        $addresse->type = $this->request->getPost("type");
        $addresse->address = $this->request->getPost("address");
        $addresse->additional_info = $this->request->getPost("additional_info");
        $addresse->zipcode = $this->request->getPost("zipcode");
        $addresse->rural = $this->request->getPost("rural");
        $addresse->district = $this->request->getPost("district");
        $addresse->city = $this->request->getPost("city");
        $addresse->province = $this->request->getPost("province");
        $addresse->country = $this->request->getPost("country");
        $addresse->phone = $this->request->getPost("phone");
        $addresse->mobile = $this->request->getPost("mobile");
        $addresse->shipping = $this->request->getPost("shipping");
        $addresse->billing = $this->request->getPost("billing");
        $addresse->created_date = $this->request->getPost("created_date");
        $addresse->last_updated_date = $this->request->getPost("last_updated_date");
        

        if (!$addresse->save()) {

            foreach ($addresse->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "addresses",
                "action" => "edit",
                "params" => array($addresse->id)
            ));
        }

        $this->flash->success("addresse was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "addresses",
            "action" => "index"
        ));

    }

    /**
     * Deletes a addresse
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $addresse = Addresses::findFirstByid($id);
        if (!$addresse) {
            $this->flash->error("addresse was not found");

            return $this->dispatcher->forward(array(
                "controller" => "addresses",
                "action" => "index"
            ));
        }

        if (!$addresse->delete()) {

            foreach ($addresse->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "addresses",
                "action" => "search"
            ));
        }

        $this->flash->success("addresse was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "addresses",
            "action" => "index"
        ));
    }

}
