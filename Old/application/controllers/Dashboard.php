<?php

/**
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : Apr 30, 2018, 5:00:56 PM
 */
class Dashboard extends BRT_Controller {

    public $viewPath = "dashboard/";
    public $modalPath = "dashboard/modal/";

    public function __construct() {
        parent::__construct();
        $this->ifNotLogin();
    }

    function index() {

        $this->navMeta = ["active" => "dashboard", "pageTitle" => "Trade Report", "bc" => array(
                ["url" => "", "page" => __CLASS__]
        )];

        $this->meta["pageJs"] = array(
        );
        $this->meta["pageCss"] = array(
        );
        $clientList = [];
        $tempClientList = $this->mdb->getData(TAB_ClientList, ["addedBy" => $this->getUserID()]);
        foreach ($tempClientList as $client) {
            array_push($clientList, ["value" => $client->clientID, "label" => $client->clientName]);
        }
        $TraderList = [];
        $tempTraderList = $this->mdb->getData(TAB_USERS);
        foreach ($tempTraderList as $trader) {
            array_push($TraderList, ["value" => $trader->id, "label" => $trader->firstName . " " . $trader->lastName]);
        }
        $this->data["TraderList"] = $TraderList;
        $this->data["clientList"] = $clientList;
        $this->view($this->viewPath . "tradeList");
    }

    function tradeList() {
        $this->navMeta = ["active" => "tradeList", "pageTitle" => "Trade List", "bc" => array(
                ["url" => user_url(), "page" => __CLASS__],
                ["url" => "", "page" => __FUNCTION__]
        )];
        $this->meta["pageJs"] = array(
        );
        $this->meta["pageCss"] = array(
        );
        $clientList = [];
        $tempClientList = $this->mdb->getData(TAB_ClientList, ["addedBy" => $this->getUserID()]);
        foreach ($tempClientList as $client) {
            array_push($clientList, ["value" => $client->clientID, "label" => $client->clientName]);
        }
        $TraderList = [];
        $tempTraderList = $this->mdb->getData(TAB_USERS);
        foreach ($tempTraderList as $trader) {
            array_push($TraderList, ["value" => $trader->id, "label" => $trader->firstName . " " . $trader->lastName]);
        }
        $this->data["TraderList"] = $TraderList;
        $this->data["clientList"] = $clientList;
        $this->view($this->viewPath . "tradeList");
    }

    function getTrades() {
        // $this->load->library("datatables");
        $extra = "";
        $dlt = "<p>Are you sure?</p><a class='btn btn-danger po-delete btn-sm p-1 rounded-0' href='" . dashboard_url('delete/Trade/$1') . "'>I am sure</a> <button class='btn pop-close btn-sm rounded-0 p-1'>No</button>";
        // $extra = "<a href='" . user_url('edituser/$1') . "' class='btn btn-link p-0 px-1' ><i class=\"fa fa-edit\"></i></a>";
        $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class=\"text-center\">"
                . "<button data-remote='" . dashboard_url('viewTrade/$1') . "' class='btn btn-link p-0 px-1' modal-toggler='true' data-target='#remoteModal1'><i class=\"fa fa-eye\"></i></button>"
                . $extra
                . "</div>";
        $tab = $this->datatables
                ->select("id, Date, (SELECT clientName FROM clientList where Client=clientList.clientID) AS Client, AccountSelection, Commission, CommissionEdited, TradeType, Side, Symbol, Shares, AveragePrice, TotalCommission, SoftDollars, NetCommission, allocationToFR, fr, PotentialReferral, Notes,(SELECT CONCAT(firstName,'',lastName) FROM users where TraderID=users.id LIMIT 1) AS TraderID")
                ->from(TAB_Trade);
        if ($_SESSION["user"]->position !== USER_ADMIN_EDITOR) {
            $tab->where(["TraderID" => $this->getUserID()]);
        }
        $tab->addColumn("actions", $action, "id");
        echo $this->datatables->generate();
    }

    function viewTrade($id) {
        $trade = $this->mdb->getSingleDataArray(TAB_Trade, ["id" => $id]);
        if (is_numeric($trade["Client"])) {
            $query = "SELECT *,(SELECT clientName FROM clientList tt WHERE tt.clientID='" . $trade["Client"] . "' LIMIT 1) as Client FROM Trade WHERE id='$id' LIMIT 1";
            $tr = $this->mdb->executeCustomArray($query);
            if ($tr) {
                $this->data["Trade"] = $tr[0];
            } else {
                $this->data["Trade"] = false;
            }
        } else {
            $this->data["Trade"] = $trade;
        }
        $this->modal($this->modalPath . "viewTrade");
    }

    function addTrade() {
        $this->meta["pageJs"] = array(
        );
        $this->meta["pageCss"] = array(
        );
        $this->navMeta = ["active" => "addTrade", "pageTitle" => "Add Trade", "bc" => array(
                ["url" => user_url(), "page" => __CLASS__],
                ["url" => "", "page" => __FUNCTION__]
        )];

        $this->form_validation->set_rules("Client", "Client Can not be blank", "required|trim");
        $this->form_validation->set_rules("PotentialReferral[]", "PotentialReferral Can not be blank", "required|trim");
        $this->form_validation->set_rules("allocationToFR", "AllocationTo FR Check box Can not be blank", "required|trim");

        if ($this->form_validation->run() == true) {
            $cols = ["Commission", "TradeType",
                "Side", "Symbol", "Shares", "AveragePrice", "TotalCommission", "SoftDollars", "NetCommission",
                "allocationToFR", "fr", "Notes"];
            foreach ($cols as $col) {
                $saveData[$col] = $this->input->post($col);
            }
            $ClientPosted = $this->input->post("Client");
            if (!$this->mdb->getSingleData(TAB_ClientList, ["clientID" => $ClientPosted])) {
                $saveData["Client"] = $this->mdb->insertData(TAB_ClientList, ["clientName" => $ClientPosted, "addedBy" => $this->getUserID()]);
            } else {
                $saveData["Client"] = $ClientPosted;
            }
            $accountSelectionPosted = $this->input->post("AccountSelection");
            if (!$this->mdb->getSingleData(TAB_ClientList, ["accountName" => $accountSelectionPosted])) {
                $saveData["AccountSelection"] = $this->mdb->insertData(TAB_ClientList, ["accountName" => $ClientPosted, "traderID" => $saveData["Client"], "addedBy" => $this->getUserID()]);
            } else {
                $saveData["AccountSelection"] = $accountSelectionPosted;
            }
            $saveData["PotentialReferral"] = implode(" , ", $this->input->post("PotentialReferral[]"));
            $saveData["CommissionEdited"] = $this->mdb->getSingleData(TAB_Trade, [
                        "Client" => $saveData["Client"],
                        "TraderID" => $this->getUserID(),
                        "Commission" => $saveData["Commission"]
                    ]) ? "No" : "Yes";
            $saveData["Date"] = changeDateFormat($this->input->post("Date"));
            $saveData["TraderID"] = $this->getUserID();
            $saveData["addedTime"] = date("Y-m-d H:i:s");
            $this->mdb->insertData(TAB_Trade, $saveData);
            $this->setAlertMsg("New Trade Added Successfully!", SUCCESS);
        } else {
            $this->setAlertMsg(validation_errors(), DANGER);
        }

        $this->view($this->viewPath . "addTrade");
    }

    function getClientList() {
        $data = [];
        $term = isset($_POST["term"]) ? $_POST["term"] : false;
        $clients = [];
        if ($_SESSION["user"]->position !== USER_ADMIN_EDITOR) {
            if ($term) {
                $clients = $this->mdb->getDataLikeWhere(TAB_ClientList, ["clientName" => $term], ["traderID" => $this->getUserID()], 0, 0, 0, "clientName");
            } else {
                $clients = $this->mdb->getData(TAB_ClientList, ["traderID" => $this->getUserID()], FALSE, 5, 0, "clientName");
            }
        } else {
            if ($term) {
                $clients = $this->mdb->getDataLikeWhere(TAB_ClientList, ["clientName" => $term], 0, 0, 0, 0, "clientName");
            } else {
                $clients = $this->mdb->getData(TAB_ClientList, 0, FALSE, 5, 0, "clientName");
            }
        }
        if ($clients) {
            foreach ($clients as $client) {
                array_push($data, ["id" => $client->clientID, "text" => $client->clientName]);
            }
        }
        echo json_encode($data);
    }

    function getAccountSelection() {
        $data = [];
        $term = isset($_POST["term"]["term"]) ? $_POST["term"]["term"] : "";
        $cli = isset($_POST["client"]) ? $_POST["client"] : false;

        if ($cli) {
            $accounts = $this->mdb->getDataLikeWhere(TAB_ClientList, ["accountName" => $term], ["clientName" => $cli], ["clientID" => "DESC"]);
        }
        if ($accounts) {
            foreach ($accounts as $account) {
                array_push($data, ["id" => $account->accountName, "text" => $account->accountName, "commission" => $account->commission]);
            }
        }
        // $data[]=$_POST;

        echo json_encode($data);
    }

    function delete($table, $id) {
        if (!$table || !$id) {
            $this->someThingWrong();
        }
        $this->setAlertMsg("Something Wrong!", DANGER);
        switch ($table) {
            case "Trade":
                if ($this->mdb->removeData(TAB_Trade, ["id" => $id])) {
                    $this->setAlertMsg("Trade Deleted Successfully!", INFO);
                }
                break;
        }
        $this->redirectToReference();
    }

}
