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


        if($_SESSION["user"]->position === USER_TMT_SUBSCRIPTION)   
        {

          $this->redirectToUrl(base_url('dashboard/tmtSubscriptionList'));
      }


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
                ->select("id, Date, (SELECT clientName FROM clientList where Client=clientList.clientID) AS Client, AccountSelection,  CONCAT ('$',Commission) as Commission, CommissionEdited, TradeType, Side, Symbol, Shares, CONCAT ('$',AveragePrice) AS AveragePrice, CONCAT ('$',TotalCommission) AS TotalCommission, CONCAT ('$',SoftDollars) AS SoftDollars, CONCAT ('$',NetCommission) AS NetCommission, allocationToFR, fr, PotentialReferral, Notes,(SELECT CONCAT(firstName,'',lastName) FROM users where TraderID=users.id LIMIT 1) AS TraderID")
                ->from(TAB_Trade);


                

                // SELECT `id`, `Date`, (SELECT clientName FROM clientList where Client=clientList.clientID) AS Client, `AccountSelection`, (SELECT commission FROM clientList where Client=clientList.clientID) AS Commission, `CommissionEdited`, `TradeType`, `Side`, `Symbol`, `Shares`, `AveragePrice`, (SELECT clientList.commission*trade.Shares FROM clientList,trade where trade.Client=clientList.clientID) AS TotalCommission, `SoftDollars`, `NetCommission`, `allocationToFR`, `fr`, `PotentialReferral`, `Notes`,(SELECT CONCAT(users.firstName, '', users.lastName) FROM users where trade.TraderID = users.id =  1) AS TraderID  FROM `trade`,`clientlist`

                $tab->order('id');
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
    
    function alertsList() {
        $this->meta["pageJs"] = array(
        );
        $this->meta["pageCss"] = array(
        );
        $this->navMeta = ["active" => "alertsList", "pageTitle" => "Add alerts List", "bc" => array(
                ["url" => user_url(), "page" => __CLASS__],
                ["url" => "", "page" => __FUNCTION__]
        )];

        $this->form_validation->set_rules("Client", "Client Can not be blank", "required|trim");
//        $this->form_validation->set_rules("PotentialReferral[]", "PotentialReferral Can not be blank", "required|trim");
//        $this->form_validation->set_rules("allocationToFR", "AllocationTo FR Check box Can not be blank", "required|trim");

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

            $saveData["CommissionEdited"] = $this->mdb->getSingleData(TAB_Trade, [
                        "Client" => $saveData["Client"],
                        "TraderID" => $this->getUserID(),
                        "Commission" => $saveData["Commission"]
                    ]) ? "No" : "Yes";
            $saveData["Date"] = changeDateFormat($this->input->post("Date"));
            $saveData["TraderID"] = $this->getUserID();
            $saveData["addedTime"] = date("Y-m-d H:i:s");
            
            $total_rows = $this->input->post('total_rows');
            $trade_val = $this->input->post('trade_val');
            for($i=0;$i<$total_rows;$i++){
                if($trade_val[$i]['Shares'] > 0){
                    $saveData['Side'] = $trade_val[$i]['Side'];
                    $saveData['Shares'] = $trade_val[$i]['Shares'];
                    $saveData['Symbol'] = $trade_val[$i]['Symbol'];
                    $saveData['AveragePrice'] = $trade_val[$i]['AveragePrice'];
                    $this->mdb->insertData(TAB_Trade, $saveData);
                }
            }
            $this->setAlertMsg("New Trade Added Successfully!", SUCCESS);
        } 
        else {
            $this->setAlertMsg(validation_errors(), DANGER);
        }
        
        $this->view($this->viewPath . "alertsList");
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
//        $this->form_validation->set_rules("PotentialReferral[]", "PotentialReferral Can not be blank", "required|trim");
//        $this->form_validation->set_rules("allocationToFR", "AllocationTo FR Check box Can not be blank", "required|trim");

        if ($this->form_validation->run() == true) {

            
          
            $cols = ["Commission", "TradeType","Side", "Symbol", "Shares", "AveragePrice", "TotalCommission", "SoftDollars", "NetCommission",
                "allocationToFR", "fr", "Notes"];
                
           	 foreach ($cols as $col) {
           	     $saveData[$col] = $this->input->post($col);
           	 }

      
           	$client_date = changeDateFormat($this->input->post("Date"));
           	 $newDate = date("d-m-Y", strtotime($client_date));
           	 $ClientPosted = $this->input->post("Client");
           	 $Commission = $this->input->post("Commission");
           	 
           	  $Client_name = $this->mdb->getclientdata($ClientPosted);
           	 
           	$clist_name=$Client_name[0]['clientName'];
           	$clist_account=$Client_name[0]['accountName'];
           	$clist_commission=$Client_name[0]['commission'];
           	$clist_trade_type=$Client_name[0]['default_tradeType'];

           	//echo "<pre>";print_r($Client_name[0]['clientName']);die;
           	
           	$get_commission = $this->mdb->getclientcommission($clist_name,$clist_account);
           	
     
            
           // if($this->input->post('SoftDollars') > 0){
                    //send mail to all person from alert_setting
                  
                    //$msg = "Recently added trade and sofdollars are ".$this->input->post('SoftDollars');
                    

                    /*$msg .="Client Name = ".$clist_name."\n";
                    $msg .="Account Name = ".$clist_account."\n";
                    $msg .="Commission = ".$clist_commission."\n";
                    $msg .="Trade Type= ".$clist_trade_type."\n";
                    $msg .="Recently Added Trade And Sofdollars Are= ".$this->input->post('SoftDollars')."\n";*/
                    
                    
                    
                  
                //}
                //if(strlen(trim($this->input->post('Notes'))) > 0){
                    //send mail to all person from alert_setting
                   
                    
                    
                    //$msg = "Recently added trade and Note is ".$this->input->post('Notes');
                    
               // }
                
                //if($get_commission[0]['commission'] != $Commission){
                
	               
                
              //}
            
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
                 
        
            $saveData["CommissionEdited"] = $this->mdb->getSingleData(TAB_Trade, [
                        "Client" => $saveData["Client"],
                        "TraderID" => $this->getUserID(),
                        "Commission" => $saveData["Commission"]
                    ]) ? "No" : "Yes";
            $saveData["Date"] = changeDateFormat($this->input->post("Date"));
            $saveData["TraderID"] = $this->getUserID();
            $saveData["addedTime"] = date("Y-m-d H:i:s");
            
            $total_rows = $this->input->post('total_rows');
            $trade_val = $this->input->post('trade_val');


            
            for($i=0;$i<$total_rows;$i++){
                if($trade_val[$i]['Shares'] > 0){

                    $saveData['Side'] = $trade_val[$i]['Side'];
                    $saveData['Shares'] = $trade_val[$i]['Shares'];
                    $saveData['Symbol'] = $trade_val[$i]['Symbol'];
                    $saveData['AveragePrice'] = number_format((float)$trade_val[$i]['AveragePrice'], 2, '.', '');
                    if(strlen(trim($this->input->post('Client'))) > 0){
                        //send mail to all person from alert_setting
                        $n_data= $this->mdb->getDataLikeWhere(TAB_AlertSetting, ["alert_name" => "client_alert"]);
						$all_emails = $n_data[0]->alert_value;
			$trade_type=$this->input->post('TradeType');
			 $msg_side = $saveData['Side'];
			 $msg_Shares = $saveData['Shares'];
			 $msg_symbol = $saveData['Symbol'];
			 $msg_averageprice = $saveData['AveragePrice'];	
             $saveData['Commission'] = 	$this->input->post('Commission');
             $saveData['TradeType'] = $this->input->post('TradeType');

            $TotalCommission = $trade_val[$i]['Shares']*$saveData['Commission'];
            $tCom =  number_format((float)$TotalCommission, 2, '.', '');

             $saveData['TotalCommission'] = $tCom;
             $saveData['SoftDollars'] = number_format((float)$trade_val[$i]['SoftDollars'], 2, '.', '');
             $saveData['Notes'] = $trade_val[$i]['Notes'];
             if($saveData['SoftDollars'] == 0)
             {

                 $saveData['NetCommission'] = number_format((float)$saveData['TotalCommission'], 2, '.', '');
             }else{
                $saveData['NetCommission'] = number_format((float)$saveData['TotalCommission']-$saveData['SoftDollars'], 2, '.', '');

             }
             
             $s_data= $this->mdb->getDataLikeWhere(TAB_AlertSetting, ["alert_name" => "soft_dollar_alert"]);
             $all_emails = $s_data[0]->alert_value;
             $msg = "Date =".$newDate."\n Client Name =".$clist_name."\n Account Name = ".$clist_account."\n Commission = $".$clist_commission."\n Trade Type =".$this->input->post('TradeType')."\n Recently Added Trade And Sofdollars Are = $".$saveData['Commission'];

            $SoftDollarsArray = array("emails"=>$all_emails,"message"=>$msg,"subject"=>"Soft Dollars Alert");
            $this->phpmailerlib->send_email($SoftDollarsArray);


             $n_data= $this->mdb->getDataLikeWhere(TAB_AlertSetting, ["alert_name" => "notes_alert"]);
             $all_emails = $n_data[0]->alert_value;

             $msg = "Date =".$newDate."\n Client Name =".$clist_name."\n Account Name = ".$clist_account."\n Commission = $".$clist_commission."\n Trade Type =".$this->input->post('TradeType')."\n Recently added trade and Note is = ".$saveData['Notes'];


            $notesAlertArray = array("emails"=>$all_emails,"message"=>$msg,"subject"=>"Notes Alert");
            $this->phpmailerlib->send_email($notesAlertArray);




             if(($this->input->post('Commission')) > 0){
                $n_data= $this->mdb->getDataLikeWhere(TAB_AlertSetting, ["alert_name" => "commission_alert"]);
                $all_emails = $n_data[0]->alert_value;
                $msg = "Recently added trade and commission is $".$saveData['Commission'];


                 $commesionArray = array("emails"=>$all_emails,"message"=>$msg,"subject"=>"Commission Alert");
                $this->phpmailerlib->send_email($commesionArray);

                
            }
			 
			 
						
			//$msg='Recently added new trade are '.$trade_type.'<br/> in that Side='.$saveData['Side'].'<br/>Shares ='.$msg_Shares.'<br/>Symbol='.$msg_symbol.'<br/>AveragePrice ='.$msg_averageprice.'';	
			//echo "<pre>";print_r($msg);die;		
                      //	$msg = "Recently added new trade are ".$this->input->post('TradeType') ."";
                       // $msg .= " in that Side = ".$saveData['Side']."<br/>";
                       // $msg .= " Shares = ".$saveData['Shares']."<br/>";
                       // $msg .= " Symbol = ".$saveData['Symbol']."<br/>";
                       // $msg .= " AveragePrice = ".$saveData['AveragePrice'];
                       // if(send_email($all_emails,"Trade added Alert",$msg)){
                       //     // mail send successfully
                       // }
                    }
                    $this->mdb->insertData(TAB_Trade, $saveData);
                }
            }
            $this->setAlertMsg("New Trade Added Successfully!", SUCCESS);
        } 
        else {
            $this->setAlertMsg(validation_errors(), DANGER);
        }
        // $this->data['clients']  = $this->mdb->getData(TAB_ClientList);
        $this->view($this->viewPath . "addTrade");
    }

    //tmt subscription 
    function TmtSubscription()
    {
     $this->meta["pageJs"] = array();
     $this->meta["pageCss"] = array();
     $this->navMeta = ["active" => "addTrade", "pageTitle" => "Add Trade", "bc" => array(
        ["url" => user_url(), "page" => __CLASS__],
        ["url" => "", "page" => __FUNCTION__]
    )];

     $this->form_validation->set_rules("accountName", "Account Can not be blank", "required|trim");
     $this->form_validation->set_rules("accountCoverage", "Account Coverage Can not be blank", "required|trim");
     $this->form_validation->set_rules("sub_payment", "Payment Can not be blank", "required|trim");
     
     if ($this->form_validation->run() == true) {

        $data = $this->input->post();
        unset($data['Date']);
        $data['Date'] = date("Y-m-d");
        $this->mdb->insertData(TAB_TmtSubscription, $data);
        $this->setAlertMsg("New TMT Subscription Added Successfully!", SUCCESS);

    }
    else {
        $this->setAlertMsg(validation_errors(), DANGER);
    }
    $this->view($this->viewPath . "addTmtSubscription");
}

    //account Coverage 
    function tmtAccountCoverage($id="")
    {
        $this->meta["pageJs"] = array();
       $this->meta["pageCss"] = array();
       $this->navMeta = ["active" => "addTrade", "pageTitle" => "Add Trade", "bc" => array(
            ["url" => user_url(), "page" => __CLASS__],
            ["url" => "", "page" => __FUNCTION__]
        )];
       if(!empty($id))
        {
            $where['id'] = $id;
            $this->data['coverage'] = $this->mdb->getSingleRow(TAB_Coverage, $where);
        }
       $this->form_validation->set_rules("accountName", "Account Can not be blank", "required|trim");
       $this->form_validation->set_rules("accountCoverage", "Account Coverage Can not be blank", "required|trim");
       if ($this->form_validation->run() == true) {

            $data = $this->input->post();
            if(isset($data['id']))
            {   
                $where['id'] = $data['id'];
                unset($data['id']);
                $this->mdb->updateData(TAB_Coverage, $data, $where); 
                $this->setAlertMsg("Account Coverage Updated Successfully!", SUCCESS);
                redirect(dashboard_url('AccountCoverageList'));
            }else
            {
                $this->mdb->insertData(TAB_Coverage, $data);
                $this->setAlertMsg("New Account Coverage Added Successfully!", SUCCESS);
            }

       }
       else {
        $this->setAlertMsg(validation_errors(), DANGER);
        }

        
        $this->view($this->viewPath . "accountCoverage");
    }

    function AccountCoverageList(){
        $this->navMeta = ["active" => "coverage_list", "pageTitle" => "Trade List", "bc" => array(
            ["url" => user_url(), "page" => __CLASS__],
            ["url" => "", "page" => __FUNCTION__]
        )];
        $this->meta["pageJs"] = array(
        );
        $this->meta["pageCss"] = array(
        );
         $this->data["coverage"] = $this->mdb->getData(TAB_Coverage);
        $this->view($this->viewPath . "coverage_list");

    }
    function getCoverageListTable() {
        $this->load->library("datatables");
        $extra = "";
         $dlt = "<p>Are you sure?</p><a class='btn btn-danger po-delete btn-sm p-1 rounded-0' href='" . dashboard_url('delete/Coverage/$1') . "'>I am sure</a> <button class='btn pop-close btn-sm rounded-0 p-1'>No</button>";
        // $extra = "<a href='" . user_url('edituser/$1') . "' class='btn btn-link p-0 px-1' ><i class=\"fa fa-edit\"></i></a>";
        $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class=\"text-center\">"
                . "<a href='" . dashboard_url('tmtAccountCoverage/$1') . "' class='btn btn-link p-0 px-1'><i class=\"fa fa-pencil-square-o\"></i></a>"
                . $extra
                . "</div>";
    
        $tab =  $this->datatables
        ->select("id,accountName,accountCoverage")
        ->from(TAB_Coverage);
         $tab->addColumn("actions", $action, "id");
        echo $this->datatables->generate();
    }


    //getAccountCoverageList
    function getAccountCoverageList() {
        $data = [];
        $term = isset($_POST["term"]) ? $_POST["term"] : false;
        $coverages = [];
        if ($_SESSION["user"]->position !== USER_ADMIN_EDITOR) {
            if ($term) {
                $coverages = $this->mdb->getDataLikeWhere(TAB_Coverage, ["accountName" => $term],0, 0, 0, 0, "accountName");
            } else {
                $coverages = $this->mdb->getData(TAB_Coverage, 0, FALSE, 0, 0, "accountName");
            }
        } else {
            if ($term) {
                $coverages = $this->mdb->getDataLikeWhere(TAB_Coverage, ["accountName" => $term],0, 0, 0, 0, "accountName");
            } else {
               $coverages = $this->mdb->getData(TAB_Coverage, 0, FALSE, 0, 0, "accountName");
            }
        }
        if ($coverages) {

            foreach ($coverages as $coverage) {
                array_push($data, ["id" => $coverage->id, "text" => $coverage->accountName, "value"=>$coverage->accountCoverage]);
            }
        }
        echo json_encode($data);
    }



    function getAccountCoverageByID()
    {
        $id = $_POST['coverageID'];
        $where['id'] = $id;
        $coverage = $this->mdb->getData(TAB_Coverage, $where, 0,1,"accountCoverage");
        $accountCoverage = $coverage[0]->accountCoverage;
        echo json_encode($accountCoverage);

    }

    function tmtSubscriptionList()
    {
        $this->navMeta = ["active" => "subscriptionList", "pageTitle" => "Trade List", "bc" => array(
            ["url" => user_url(), "page" => __CLASS__],
            ["url" => "", "page" => __FUNCTION__]
        )];
        $this->meta["pageJs"] = array(
        );
        $this->meta["pageCss"] = array(
        );
         $this->data["coverage"] = $this->mdb->getData(TAB_Coverage);

         $this->data['tmtSub'] =  $this->mdb->tmtsub(TAB_Coverage);

         // echo "<pre>";
         // print_r($this->data);
         // exit();
        $this->view($this->viewPath . "subscriptionList");
    }

    function getSubscriptionListTable() {
        $this->load->library("datatables");
        $extra = "";
         $dlt = "<p>Are you sure?</p><a class='btn btn-danger po-delete btn-sm p-1 rounded-0' href='" . dashboard_url('delete/Subscription/$1') . "'>I am sure</a> <button class='btn pop-close btn-sm rounded-0 p-1'>No</button>";
        // $extra = "<a href='" . user_url('edituser/$1') . "' class='btn btn-link p-0 px-1' ><i class=\"fa fa-edit\"></i></a>";
        $extra .= '<button type="button" class="btn btn-link p-0 px-1" data-container="body" data-toggle="popover" data-placement="left" data-html="true" data-content="' . $dlt . '"><i class="fa fa-trash"></i></button>';
        $action = "<div class=\"text-center\">"
                . $extra
                . "</div>";
    
        $tab =  $this->datatables
        ->select("accountName,accountCoverage,sub_payment,notes,Date,s_id")
        ->from(TAB_TmtSubscription);
         $tab->addColumn("actions", $action, "s_id");
        echo $this->datatables->generate();
    }




    
    function addTrade_old() {
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
                $clients = $this->mdb->getData(TAB_ClientList, ["traderID" => $this->getUserID()], FALSE, 0, 0, "clientName");
            }
        } else {
            if ($term) {
                $clients = $this->mdb->getDataLikeWhere(TAB_ClientList, ["clientName" => $term], 0, 0, 0, 0, "clientName");
            } else {
                $clients = $this->mdb->getData(TAB_ClientList, 0, FALSE, 0, 0, "clientName");
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
                array_push($data, ["id" => $account->accountName, "text" => $account->accountName, "commission" => $account->commission,"default_tradeType" => $account->default_tradeType]);
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
            case "Coverage":
                if ($this->mdb->removeData(TAB_Coverage, ["id" => $id])) {
                    $this->setAlertMsg("Coverage Deleted Successfully!", INFO);
                }
                break;
                 case "Subscription":
                if ($this->mdb->removeData(TAB_TmtSubscription, ["s_id" => $id])) {
                    $this->setAlertMsg("Subscription Deleted Successfully!", INFO);
                }
                break;
        }
        $this->redirectToReference();
    }

}
