<?php

/**
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : Apr 30, 2018, 3:37:15 PM
 */
class Site extends BRT_Controller {

    public $viewPath = "";

    public function __construct() {
        parent::__construct();
        
       $this->ifLogin();
    }

    function index() {
        $this->login();
    }

    function login() {      
        $this->navBarSettings(FALSE, FALSE, false);
        $this->meta["pageJs"] = array(
            property_url("app-assets/js/scripts/forms/form-login-register.js")
        );
        $this->meta["pageCss"] = array(
            property_url("app-assets/css/pages/login-register.css")
        );

        $this->form_validation->set_rules("username", "Username can not be blank!", 'trim|required');
        $this->form_validation->set_rules("password", "Password can not be blank!", 'required');
        if ($this->form_validation->run() === true) {

            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $user = $this->mdb->getSingleData(TAB_USERS, ["email" => $username]);

   
            if ($user) {
      
                $storedPassword = $this->encryption->decrypt($user->password);
                if ($storedPassword == $password) {
                    $this->session->set_userdata("user", $user);
          
                    if($_SESSION["user"]->position === USER_TMT_SUBSCRIPTION)
                    {
                      
                      $this->redirectToUrl(base_url('dashboard/tmtSubscriptionList'));
                    }
                    else
                    {

                    $this->redirectToUrl(dashboard_url());
                    }
                    
                } else {
                    $this->redirectToReference("Incorrect Password!", "danger");
                }
            } else {
                $this->redirectToReference("Incorrect Username or Password!", "danger");
            }
        } else {
            $this->setAlertMsg(validation_errors(), DANGER);
        }

        $this->view($this->viewPath . "login");
    }

    function recoverPassword() {
        $this->meta["pageJs"] = array(
            property_url("app-assets/js/scripts/forms/form-login-register.js")
        );
        $this->meta["pageCss"] = array(
            property_url("app-assets/css/pages/login-register.css")
        );
        $this->navBarSettings(FALSE, FALSE, false);
        $this->form_validation->set_rules("email", "Email can not be blank!", 'required');
        $this->form_validation->valid_email($this->input->post("email"));
        if ($this->form_validation->run() === true) {
            $email = $this->input->post("email");
            $user = $this->mdb->getSingleData(TAB_USERS, ["email" => $email]);
            if ($user) {
                $this->email->from(SITE_EMAIL, SYSTEM_NAME);
                $this->email->to($user->email);
                $this->email->subject('Password recover request');
                $this->email->message("Hello ," .
                        "<br>" .
                        "A password recover request has been received for <a href='" . base_url() . "'>" . SITE_NAME . "</a><br>" .
                        "<a terget='_blank' href='" . base_url("reset?email=" . $email . "&hash=" . password_hash($this->encryption->decrypt($user->password), PASSWORD_BCRYPT)) . "'><strong>Click here</strong></a> to reciver your password." .
                        "<br>Thanks"
                );
                $this->email->send();
                $this->setAlertMsg("Recover Email sent Successfully!", SUCCESS);
            } else {
                $this->setAlertMsg("Something Wrong!", DANGER);
            }
        }
        $this->view($this->viewPath . "recoverPassword");
    }

    function reset() {
        $this->meta["pageJs"] = array(
            property_url("app-assets/js/scripts/forms/form-login-register.js")
        );
        $this->meta["pageCss"] = array(
            property_url("app-assets/css/pages/login-register.css")
        );
        $this->navBarSettings(FALSE, FALSE, false);
        $user = $this->mdb->getSingleData(TAB_USERS, ["email" => $this->input->get("email")]);

        if ($user) {
            if (!password_verify($this->encryption->decrypt($user->password), $this->input->get("hash"))) {
                $this->setAlertMsg("Request not exisist!", SUCCESS);
            }
            $this->data["user"] = $user;
            $this->view($this->viewPath . "reset");
        }
       // $this->someThingWrong();
        
    }

    function ressetPassword() {
        if ($this->input->post("oldPassword")) {
            $this->form_validation->set_rules("email", "Email can not be blank!", 'required');
            $this->form_validation->set_rules("password", "Password can not be blank!", 'required');
            if ($this->form_validation->run() === true) {
                $password = $this->encryption->encrypt($this->input->post("password"));
                $this->mdb->updateData(TAB_USERS, ["password" => $password], ["email" => $this->input->post("email"),"password"=> $this->input->post("oldPassword")]);
                $this->setAlertMsg("Password Chnaged successfully!<br>Login here..", SUCCESS);
            } else {
                $this->setAlertMsg("Something Wrong!", DANGER);
            }
        } else {
            $this->setAlertMsg("Request not exisist!", SUCCESS);
        }
        $this->redirectToUrl(base_url());
    }

    /* function signUp($userType) {

      $this->form_validation->set_rules("email", "Email can not be blank!", 'trim|required');
      $this->form_validation->set_rules("password", "Password can not be blank!", 'required');
      if ($this->form_validation->run() === true) {
      if ($userType == "driver") {
      $saveData = [];
      $cols = ["firstName", "lastName", "email", "ssn"];
      foreach ($cols as $col) {
      $saveData[$col] = $this->input->post($col);
      }
      $saveData["birthDate"] = changeDateFormat($this->input->post("birthDate"));
      $saveData["password"] = $this->encryption->encrypt($this->input->post("password"));
      $saveData["signupIP"] = $this->input->ip_address();
      $saveData["signupTime"] = date("Y-m-d H:i:s");
      if ($this->mdb->insertData(TAB_DRIVERS, $saveData)) {
      $this->redirectToUrl(login_url() . "/driver", "Driver Signup completed!<br>Please Login Here", "success");
      } else {
      $this->redirectToReference("Something wrong", "error");
      }
      }
      if ($userType == "carrier") {
      $saveData = [];
      $cols = ["businessName", "mc", "usDot", "email", "taxID"];
      foreach ($cols as $col) {
      $saveData[$col] = $this->input->post($col);
      }
      $saveData["password"] = $this->encryption->encrypt($this->input->post("password"));
      $saveData["signupIP"] = $this->input->ip_address();
      $saveData["signupTime"] = date("Y-m-d H:i:s");
      if ($this->mdb->insertData(TAB_CARRIERS, $saveData)) {
      $this->redirectToUrl(login_url() . "/carrier", "Carrier Signup completed!<br>Please Login Here", "success");
      } else {
      $this->redirectToReference("Something wrong", "error");
      }
      }
      } else {
      $this->setAlertMsg(validation_errors(), DANGER);
      }
      $this->data["userType"] = strtolower($userType);
      $this->meta["pageJs"] = array(
      property_url("app-assets/js/scripts/forms/form-login-register.js")
      );
      $this->meta["pageCss"] = array(
      property_url("app-assets/css/pages/login-register.css")
      );
      $this->navBarSettings(FALSE, FALSE,false);
      $this->view($this->viewPath . "signup");
      } */
}
			