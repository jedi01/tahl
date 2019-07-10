<?php

/**
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : May 12, 2018, 2:10:17 PM
 * @property Datatables $datatables Description
 */
class Settings extends BRT_Controller {

    public $viewPath = "settings/";
    public $modalPath = "settings/modal/";

    public function __construct() {
        parent::__construct();
        $this->ifNotLogin();
        $this->ifNotAdmin();
    }

    function index() {
        $this->users();
    }

    function users() {
        $this->navMeta = ["active" => "users", "pageTitle" => "User List", "bc" => array(
                ["url" => settings_url(), "page" => __CLASS__], ["url" => "", "page" => __FUNCTION__]
        )];
        $this->meta["pageJs"] = array(
        );
        $this->meta["pageCss"] = array(
        );
        $this->view($this->viewPath . __FUNCTION__);
    }

    function getUsers() {
        $this->load->library("datatables");
        $dlt = "<p>Are you sure?</p><a class='btn btn-danger po-delete btn-sm p-1 rounded-0' href='" . settings_url('delete/users/$1') . "'>I am sure</a> <button class='btn pop-close btn-sm rounded-0 p-1'>No</button>";
        $extra = "<a href='" . user_url('edituser/$1') . "' class='btn btn-link p-0 px-1' ><i class=\"fa fa-edit\"></i></a>";
        $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class=\"text-center\">"
                //  . "<button data-remote='" . dashboard_url('viewData/$1') . "' class='btn btn-link p-0 px-1' modal-toggler='true' data-target='#remoteModal1'><i class=\"fa fa-eye\"></i></button>"
                . $extra
                . "</div>";
        $this->datatables
                ->select("id,firstName,lastName,phoneNumber,email,position")
                ->from(TAB_USERS)
                ->addColumn("actions", $action, "id");
        echo $this->datatables->generate();
    }

    function delete($table, $id) {
        if (!$table || !$id) {
            $this->someThingWrong();
        }
        $this->setAlertMsg("Something Wrong!", DANGER);
        switch ($table) {
            case "users":
                if ($id == $this->getUserID()) {
                    $this->someThingWrong();
                }
                if ($this->mdb->removeData(TAB_USERS, ["id" => $id])) {
                    $this->setAlertMsg("User Deleted Successfully!", INFO);
                }
                break;
            case "clients":
                if ($this->mdb->removeData(TAB_ClientList, ["clientID" => $id])) {
                    $this->setAlertMsg("Client Deleted Successfully!", INFO);
                }
                break;
        }
        $this->redirectToReference();
    }

    function getClientsListTable() {
        $this->load->library("datatables");
        $extra = "";
        $dlt = "<p>Are you sure?</p><a class='btn btn-danger po-delete btn-sm p-1 rounded-0' href='" . settings_url('delete/clients/$1') . "'>I am sure</a> <button class='btn pop-close btn-sm rounded-0 p-1'>No</button>";
        $extra = "<button modal-toggler='true' data-target='#remoteModal1' data-remote='" . settings_url('editClient/$1') . "' class='btn btn-link p-0 px-1' ><i class=\"fa fa-edit\"></i></button>";
        $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class=\"text-center\">"
                . $extra
                . "</div>";
        $this->datatables
                ->select("clientID,commission,accountName,clientName,(SELECT CONCAT(firstName,' ',lastName) FROM users WHERE users.id=traderID) AS traderID")
                ->from(TAB_ClientList)
               // ->where(["TraderID" => $this->getUserID()])
                ->addColumn("actions", $action, "clientID");
        echo $this->datatables->generate();
    }

    function clientList() {
        $this->navMeta = ["active" => "clientList", "pageTitle" => "Client List", "bc" => array(
                ["url" => user_url(), "page" => __CLASS__],
                ["url" => "", "page" => __FUNCTION__]
        )];
        $this->meta["pageJs"] = array(
        );
        $this->meta["pageCss"] = array(
        );
        $this->data["users"] = $this->mdb->getData(TAB_USERS);
        $this->view($this->viewPath . "clientList");
    }

    function newClient() {
        $this->form_validation->set_rules("accountName", "Account Name Can not be blank", "required");
        $this->form_validation->set_rules("clientName", "Client Name Can not be blank", "required");
        $this->form_validation->set_rules("traderID","Trader Can not be blank", "required");
        if ($this->form_validation->run() == true) {
            $cols = ["accountName", "traderID", "commission", "clientName"];
            foreach ($cols as $col) {
                $saveData[$col] = $this->input->post($col);
            }
            $saveData["addedBy"] = $this->getUserID();
            $this->mdb->insertData(TAB_ClientList, $saveData);
            $this->setAlertMsg("New Client Successfully!", SUCCESS);
            return $this->redirectToReference();
        } else {
            if (isset($_POST["clientName"])) {
                $this->setAlertMsg(validation_errors(), DANGER);
                return $this->redirectToReference();
            }
        }
        $this->data["clients"] = $this->mdb->getData(TAB_USERS);
        $this->modal($this->modalPath . "newClient");
    }

    function editClient($id) {
        $this->form_validation->set_rules("accountName", "Account Name Can not be blank", "required");
        $this->form_validation->set_rules("clientName", "Client Name Can not be blank", "required");

        if ($this->form_validation->run() == true) {
            $cols = ["accountName", "commission", "clientName"];
            foreach ($cols as $col) {
                $saveData[$col] = $this->input->post($col);
            }
            $this->mdb->updateData(TAB_ClientList, $saveData, ["clientID" => $id]);
            $this->setAlertMsg("Client Edited Successfully!", SUCCESS);
            return $this->redirectToReference();
        } else {
            if (isset($_POST["clientName"])) {
                $this->setAlertMsg(validation_errors(), DANGER);
                return $this->redirectToReference();
            }
        }
        $this->data["client"] = $this->mdb->getSingleData(TAB_ClientList, ["clientID" => $id]);
        $this->modal($this->modalPath . "editClient");
    }

    function getTraderList() {
        $data = [];
        $term = isset($_POST["term"]) ? $_POST["term"] : false;
        $clients = [];
        if ($term) {
            $clients = $this->mdb->getDataLikeWhere(TAB_USERS, ["firstName" => $term, "lastName" => $term]);
        } else {
            $clients = $this->mdb->getData(TAB_USERS, 0, FALSE, 5);
        }
        if ($clients) {
            foreach ($clients as $client) {
                array_push($data, ["id" => $client->id, "text" => $client->firstName . " " . $client->lastName]);
            }
        }
        echo json_encode($data);
    }

}
