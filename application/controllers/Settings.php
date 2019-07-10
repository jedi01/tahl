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
       // $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class=\"text-center\">"
                //  . "<button data-remote='" . dashboard_url('viewData/$1') . "' class='btn btn-link p-0 px-1' modal-toggler='true' data-target='#remoteModal1'><i class=\"fa fa-eye\"></i></button>"
                . $extra
                . "</div>";
        $this->datatables
                ->select("id,firstName,lastName,phoneNumber,email,position")
                ->from(TAB_USERS)
                ->where(["status" => 1])                
                ->addColumn("actions", $action, "id");
        echo $this->datatables->generate();
    }

    function delete($table, $id) {
        if (!$table || !$id) {
            $this->someThingWrong();
        }
        $this->setAlertMsg("Something Wrong1!", DANGER);
        switch ($table) {
            case "users":
                if ($id == $this->getUserID()) {
                    $this->someThingWrong();
                }
               /*
                if ($this->mdb->removeData(TAB_USERS, ["id" => $id])) {
                    $this->setAlertMsg("User Deleted Successfully!", INFO);
                }
		 */		
		if ($this->mdb->updateData(TAB_USERS,["status" => 0] ,["id" => $id])) {
                    $this->setAlertMsg("User Deleted Successfully!", INFO);
                }
                break;
            case "clients":
                /*
                if ($this->mdb->removeData(TAB_ClientList, ["clientID" => $id])) {
                    $this->setAlertMsg("Client Deleted Successfully!", INFO);
                }
	       */
		if ($this->mdb->updateData(TAB_ClientList,["status" => 0] ,["clientID" => $id])) {
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
       // $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class=\"text-center\">"
                . $extra
                . "</div>";
        $this->datatables
                ->select("clientID,commission,accountName,clientName,default_tradeType,grouping, (SELECT CONCAT(firstName,' ',lastName) FROM users WHERE users.id=traderID) AS traderID")
                ->from(TAB_ClientList)
                ->where(["status" => 1])
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
//ALTER TABLE `clientlist` ADD `default_tradeType` VARCHAR(200) NOT NULL DEFAULT 'Single Stock' AFTER `commission`;
    function newClient() {
        $this->form_validation->set_rules("accountName", "Account Name Can not be blank", "required");
        $this->form_validation->set_rules("clientName", "Client Name Can not be blank", "required");
        $this->form_validation->set_rules("traderID","Trader Can not be blank", "required");
        $this->form_validation->set_rules("default_tradeType","Default Trade Type Can not be blank", "required");
         $this->form_validation->set_rules("grouping","Grouping Can not be blank", "required");
        
        $s_data= $this->mdb->getDataLikeWhere(TAB_AlertSetting, ["alert_name" => "client_alert"]);
        $all_emails = $s_data[0]->alert_value;
        
        if ($this->form_validation->run() == true) {
            $cols = ["accountName", "traderID", "commission", "clientName","default_tradeType",'grouping'];
            foreach ($cols as $col) {
                $saveData[$col] = $this->input->post($col);
            }
            $saveData["addedBy"] = $this->getUserID();
            
           		$trader_name = $this->mdb->gettraderdata($saveData['traderID']);
			$fname=$trader_name[0]['firstName'];
			$lname=$trader_name[0]['lastName'];
			$name_trader = $fname. $lname;
	
			
			$msg = "Client Information Is\n ========== \n
					Trader  Name =".$name_trader."\n
					Client  Name =".$saveData['clientName']."\n 
					Account Name =".$saveData['accountName']."\n 
					Commission =".$saveData['commission']."\n 
                    grouping =".$saveData['grouping']."\n 
					Trade Type =".$saveData['default_tradeType']."";
	  

                    $clientArray = array("emails"=>$all_emails,"message"=>$msg,"subject"=>"Client Alert");
                    $this->phpmailerlib->send_email($clientArray);


            $saveData['grouping'] = $this->input->post("grouping");
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

    function editClient_backup($id) {
        $this->form_validation->set_rules("accountName", "Account Name Can not be blank", "required");
        $this->form_validation->set_rules("clientName", "Client Name Can not be blank", "required");

        if ($this->form_validation->run() == true) {
            $cols = ["accountName", "commission", "clientName","default_tradeType"];
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
    
    
    function editClient($id) {
        $this->form_validation->set_rules("accountName", "Account Name Can not be blank", "required");
        $this->form_validation->set_rules("clientName", "Client Name Can not be blank", "required");
        
        	$s_data= $this->mdb->getDataLikeWhere(TAB_AlertSetting, ["alert_name" => "client_alert"]);
            $all_emails = $s_data[0]->alert_value;
            //echo "<pre>";print_r($all_emails);die;
         /*  $oldclientName = $this->input->post('hideen_clientName');
            $oldaccountName = $this->input->post('hideen_accountName');
            $oldcommission = $this->input->post('hideen_commission');
            $olddefault_tradeType= $this->input->post('hideen_default_tradeType');*/
            
        if ($this->form_validation->run() == true) {
            $cols = ["accountName", "commission", "clientName","default_tradeType"];
            $oldcols = ["hideen_traderID","hideen_accountName", "hideen_commission", "hideen_clientName","hideen_default_tradeType"];
            foreach ($cols as $col) {
                $saveData[$col] = $this->input->post($col);
            }
            
            foreach ($oldcols as $colold) {
                $oldsaveData[$colold] = $this->input->post($colold);
            }
            
            $trader_name = $this->mdb->gettraderdata($oldsaveData['hideen_traderID']);
            $fname=$trader_name[0]['firstName'];
           $lname=$trader_name[0]['lastName'];
           $name_trader = $fname. $lname;
          //echo "<pre>";print_r($oldsaveData['hideen_clientName']);die;
           
$msg = "Previous Values Is \n ========= \n Trader =".$name_trader."\n Client Name =".$oldsaveData['hideen_clientName']."\n Account Name =".$oldsaveData['hideen_accountName']."\n Commission =".$oldsaveData['hideen_commission']."\n Trade Type =".$oldsaveData['hideen_default_tradeType']."\n===========\n Edit New Values Is \n ========== \n Client Name =".$saveData['clientName']."\n Account Name=".$saveData['accountName']."\n Commission =".$saveData['commission']."\n  grouping =".$saveData['grouping']."\n  Trade Type =".$saveData['default_tradeType']."";
                    
    
                    $editClientAlert = array("emails"=>$all_emails,"message"=>$msg,"subject"=>"Client Alert");
                    $this->phpmailerlib->send_email($editClientAlert);

                   
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
            $clients = $this->mdb->getData(TAB_USERS,['status'=>1], FALSE, 5);
        }
        if ($clients) {
            foreach ($clients as $client) {
                array_push($data, ["id" => $client->id, "text" => $client->firstName . " " . $client->lastName]);
            }
        }
        echo json_encode($data);
    }


    function reports(){

        $data = $this->input->post();

        $Sdate = date_create($data['start_date']);
        $Edate = date_create($data['end_date']);

        $startDate =  date_format($Sdate,"Y-m-d");
        $endDate =  date_format($Edate,"Y-m-d");

        $tmtTradeWhere['grouping'] = "TMT Trades";
        $this->data['tmtTrade'] = $this->mdb->getTrade($tmtTradeWhere,$startDate,$endDate);

        $tmtsubscriptionWhere['grouping'] = "TMT Subscriptions";
        $this->data['tmtsubscription'] = $this->mdb->getTrade($tmtsubscriptionWhere,$startDate,$endDate);


        $floorWhere['grouping'] = "Floor";
        $this->data['floor'] = $this->mdb->getTrade($floorWhere,$startDate,$endDate);


        $upstairsWhere['grouping'] = "Upstairs/Desk";
        $this->data['upstairs'] = $this->mdb->getTrade($upstairsWhere,$startDate,$endDate);

        $this->data['startDate'] = $data['start_date'];
        $this->data['endDate'] = $data['end_date'];




        $s_data= $this->mdb->getDataLikeWhere(TAB_AlertSetting, ["alert_name" => "report_daily"]);
        $message = $this->load->view("reportView",$this->data,true);
        $all_emails = $s_data[0]->alert_value;
        $subject = "Report";

        $emailData = array("emails"=>$all_emails,"message"=>$message,"subject"=>$subject,"cc"=>$data['email_recipients']);

    //    print_r($emailData);
      //  exit;

        $mail  = $this->phpmailerlib->send_email($emailData);
        if($mail)
        {
            $this->setAlertMsg("Email Send Successfully!", SUCCESS);
                     redirect(base_url('settings/alertsList'));  
        }
        else
        {
            $this->setAlertMsg("Email Not Send!", DANGER);
            redirect(base_url('settings/alertsList'));  
        }

        exit();

       

        // $config = array();
        // $config['useragent']           = "CodeIgniter";
        // $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        // $config['protocol']            = "smtp";
        // $config['smtp_host']           = "localhost";
        // $config['smtp_port']           = "25";
        // $config['mailtype'] = 'html';
        // $config['charset']  = 'utf-8';
        // $config['newline']  = "\r\n";
        // $config['wordwrap'] = TRUE;

        // $this->load->library('email');

        // $this->email->initialize($config);

        // $this->email->from('admin@eod.rf.gd', '- Reply');
        // $this->email->to("blackdesire002@gmail.com");

        // $this->email->subject('Report');
      
        // $this->email->message($message);

        // $mail = $this->email->send();
        
        //     if($mail)
        // {
        //     echo "mail send successfully";
        // }
        // else
        // {
        //      echo "mail not send ";
        // }
       
            

          
         






    }
    
    function alertsList() {
	$this->meta["pageJs"] = array(
        );
        $this->meta["pageCss"] = array(
        );
        $this->navMeta = ["active" => "addTrade", "pageTitle" => "Add Alert Email", "bc" => array(
                ["url" => user_url(), "page" => __CLASS__],
                ["url" => "", "page" => __FUNCTION__]
        )];
        $term = isset($_POST["term"]) ? $_POST["term"] : false;
        $clients = [];
        $settings = [];
        $data = [];
        $data1 = [];
        
        $soft_dollar_alert = isset($_POST["soft_dollar_alert"]) ? $_POST["soft_dollar_alert"] : false;
        $notes_alert = isset($_POST["notes_alert"]) ? $_POST["notes_alert"] : false;
        $commission_alert = isset($_POST["commission_alert"]) ? $_POST["commission_alert"] : false;
        $client_alert = isset($_POST["client_alert"]) ? $_POST["client_alert"] : false;
        $alert_msg = FALSE;
        if($soft_dollar_alert != FALSE){
            $s_data= $this->mdb->getDataLikeWhere(TAB_AlertSetting, ["alert_name" => "soft_dollar_alert"]);
            if(count($s_data) > 0){
                // need to update
                $saveData['alert_value'] = $_POST["soft_dollar_alert"];
                $this->mdb->updateData(TAB_AlertSetting, $saveData, ["id" => $s_data[0]->id]);
            }else{
                // need to insert
                $saveData['alert_name'] = "soft_dollar_alert";
                $saveData['alert_value'] = $_POST["soft_dollar_alert"];
                $this->mdb->insertData(TAB_AlertSetting, $saveData);
            }
            $alert_msg = true;
        }
        if($notes_alert != FALSE){
            $n_data= $this->mdb->getDataLikeWhere(TAB_AlertSetting, ["alert_name" => "notes_alert"]);
            if(count($n_data) > 0){
                // need to update
                $saveData['alert_value'] = $_POST["notes_alert"];
                $this->mdb->updateData(TAB_AlertSetting, $saveData, ["id" => $n_data[0]->id]);
            }else{
                // need to insert
                $saveData['alert_name'] = "notes_alert";
                $saveData['alert_value'] = $_POST["notes_alert"];
                $this->mdb->insertData(TAB_AlertSetting, $saveData);
            }
            $alert_msg = true;
        }
        if($commission_alert != FALSE){
            $c_data= $this->mdb->getDataLikeWhere(TAB_AlertSetting, ["alert_name" => "commission_alert"]);
            if(count($c_data) > 0){
                // need to update
                $saveData['alert_value'] = $_POST["commission_alert"];
                $this->mdb->updateData(TAB_AlertSetting, $saveData, ["id" => $c_data[0]->id]);
            }else{
                // need to insert
                $saveData['alert_name'] = "commission_alert";
                $saveData['alert_value'] = $_POST["commission_alert"];
                $this->mdb->insertData(TAB_AlertSetting, $saveData);
            }
            $alert_msg = true;
        }
        if($client_alert != FALSE){
            $ca_data= $this->mdb->getDataLikeWhere(TAB_AlertSetting, ["alert_name" => "client_alert"]);
            if(count($ca_data) > 0){
                // need to update
                $saveData['alert_value'] = $_POST["client_alert"];
                $this->mdb->updateData(TAB_AlertSetting, $saveData, ["id" => $ca_data[0]->id]);
            }else{
                // need to insert
                $saveData['alert_name'] = "client_alert";
                $saveData['alert_value'] = $_POST["client_alert"];
                $this->mdb->insertData(TAB_AlertSetting, $saveData);
            }
            $alert_msg = true;
        }
        if($alert_msg){
             $this->setAlertMsg("Emails Updated Successfully!", SUCCESS);
        }
//        if ($term) {
//            $clients = $this->mdb->getDataLikeWhere(TAB_USERS, ["firstName" => $term, "lastName" => $term]);
//        } else {
//            $clients = $this->mdb->getData(TAB_USERS, 0, FALSE, 5);
//        }
//        if ($clients) {
//            foreach ($clients as $client) {
//                array_push($data, ["id" => $client->id, "text" => $client->firstName . " " . $client->lastName]);
//            }
//        }
        $settings = $this->mdb->getData(TAB_AlertSetting, 0, FALSE);
        if(count($settings) > 0){
            foreach ($settings as $alert) {
                $data1[$alert->alert_name]['id'] = $alert->id;
                $data1[$alert->alert_name]['alert_name'] = $alert->alert_name;
                $data1[$alert->alert_name]['alert_value'] = $alert->alert_value;
//                array_push($data, ["setting_id" => $alert->id, "alert_name" => $alert->alert_name, "alert_value" => $alert->alert_value]);
            }
        }
        $this->data['recipents'] = $this->mdb->getData(TAB_USERS);
        $this->data["client"] = $data1;
        $this->view($this->viewPath . "alertsList");
    }

}
