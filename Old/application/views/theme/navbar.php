<?php
/**
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : Apr 30, 2018, 3:46:43 PM
 */
if ($navBarSettings["topBar"]) {
    ?>
    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand navbar fixed-top navbar-light  bg-gradient-directional-white navbar-shadow text-">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item">
                        <a class="navbar-brand" href="<?= base_url() ?>">
                            <img class="brand-logo" alt="stack admin logo" src="<?= logoSrc() ?>" width="200">
                        </a>
                    </li>
                    <!--                    <li class="nav-item d-md-none">
                                            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a>
                                        </li>-->
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="navbar-expand" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown  nav-item">
                            <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ft-home"></i><span class="selected-language"></span></a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= dashboard_url("tradeList") ?>">Trade List</a>
                                <a class="dropdown-item" href="<?= dashboard_url("addTrade") ?>">Add Trade</a>                                
                            </div>
                        </li>    
                        <?php
                        if ($_SESSION["user"]->admin) {
                            ?>
                            <li class="dropdown nav-item">
                                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ft-settings"></i><span class="selected-language"></span></a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?= settings_url("users") ?>">Users List</a>
                                    
                                    <a class="dropdown-item" href="<?= settings_url("clientList") ?>">Client List</a>
                                </div>
                            </li>    
                        <?php }
                        ?>
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="avatar avatar-online">
                                    <img src="<?= property_url() ?>images/avatar.png" alt="avatar"><i></i></span>
                                <span class="user-name"><?= $currentUser->lastName ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="<?= user_url("profile") ?>" id="profile_nav"><i class="ft-user"></i> Edit Profile</a>                        
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= user_url("logout") ?>"><i class="ft-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>   
    <?php
}

if ($navBarSettings["slideBar"]) {
    ?>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow menu-collapsible" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" navigation-header">
                    <span>General</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
                                           data-original-title="General"></i>
                </li>
                <li class=" nav-item"><a href="#">
                        <i class="ft-home"></i>
                        <span class="menu-title" data-i18n="">Dashboard</span>
    <!--                        <span class="badge badge badge-primary badge-pill float-right mr-2">3</span>-->
                    </a>
                    <ul class="menu-content">
                        <li id="tradeList_nav"><a class="menu-item" href="<?= dashboard_url("tradeList") ?>">Trade List</a></li>
                        <li id="addTrade_nav"><a class="menu-item" href="<?= dashboard_url("addTrade") ?>">Add Trade</a></li>
                    </ul>
                </li>
                <?php
                if ($_SESSION["user"]->admin) {
                    ?>
                    <li class="nav-item"><a href="#">
                            <i class="ft-settings"></i>
                            <span class="menu-title" data-i18n="">Settings</span>                        
                        </a>                    
                        <ul class="menu-content">
                            <li id="users_nav"><a class="menu-item" href="<?= settings_url("users") ?>">Users</a></li>                       
                            <li id="addUser_nav"><a class="menu-item" href="<?= user_url("addUser") ?>">Add User</a></li>                       
                        </ul>
                    </li>
                    <?php
                }
                ?>            
            </ul>
        </div>
    </div>
    <?php
}
if (isset($navMeta["active"])) {
    ?>

        <!--    <script>
                document.getElementById("<?= $navMeta["active"] ?>_nav").className += "active";

            </script>-->
    <?php
}
?>
<div class="app-content content">
    <div class="content-wrapper p-1">        
        <?php
        if (!$navMeta["hideContentHeader"]) {
            ?>
            <div class="content-header">
                <div class="content-header-left col-md-6 col-12 mb-1">
                    <h3 class="content-header-title mb-0"><?= $navMeta["pageTitle"] ?></h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <?php
                                $navMeta["n"] = 1;
                                foreach ($navMeta["bc"] as $bc) {
                                    $navMeta["n"] ++;
                                    ?>
                                    <li class="breadcrumb-item <?= $navMeta["n"] == sizeof($navMeta["bc"]) ? "active" : "" ?>">

                                        <?php
                                        if ($bc["url"] && isset($bc["url"])) {
                                            ?>
                                            <a href="<?= $bc["url"] ?>"><?= $bc["page"] ?></a>
                                            <?php
                                        } else {
                                            ?><?= $bc["page"] ?>
                                            <?php
                                        }
                                        ?>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>            
            <?php
        }
        if ($navBarSettings["topAlert"]) {

            if (isset($_SESSION["altMsg"])) {
                ?>
                <div class="alert brt-alert alert-dismissible alert-<?= isset($_SESSION["altMsgType"]) ? $_SESSION["altMsgType"] : "info" ?>">
                    <?= $_SESSION["altMsg"] ?>
                </div>
                <?php
                unset($_SESSION["altMsg"]);
            }
        }
        if ($navBarSettings["topBar"]) {
            ?>
            <div class="content-body bg-white p-1">
                <?php
            }
            ?>