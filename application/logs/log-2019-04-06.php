<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-04-06 18:36:56 --> Severity: Warning --> implode(): Invalid arguments passed E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 283
ERROR - 2019-04-06 18:36:56 --> Severity: Notice --> Undefined index: Commission E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 287
ERROR - 2019-04-06 18:38:10 --> Severity: Warning --> implode(): Invalid arguments passed E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 281
ERROR - 2019-04-06 18:38:26 --> Severity: Warning --> implode(): Invalid arguments passed E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 281
ERROR - 2019-04-06 18:42:53 --> Query error: Unknown column '$' in 'field list' - Invalid query: SELECT `id`, `Date`, (SELECT clientName FROM clientList where Client=clientList.clientID) AS Client, `AccountSelection`, (SELECT FORMAT(Commission, 2)) as formatcom, CONCAT ($, formatcom) as Commission, `CommissionEdited`, `TradeType`, `Side`, `Symbol`, `Shares`, `AveragePrice`, `TotalCommission`, `SoftDollars`, `NetCommission`, `allocationToFR`, `fr`, `PotentialReferral`, `Notes`, (SELECT CONCAT(firstName, '', lastName) FROM users where TraderID=users.id LIMIT 1) AS TraderID
FROM `Trade`
ORDER BY `Date` DESC
 LIMIT 25
ERROR - 2019-04-06 18:42:57 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:42:57 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:42:59 --> Severity: Notice --> Undefined index: iColumns E:\xampp7\htdocs\tahl\application\libraries\Datatables.php 44
ERROR - 2019-04-06 18:42:59 --> Severity: Notice --> Undefined index: iColumns E:\xampp7\htdocs\tahl\application\libraries\Datatables.php 52
ERROR - 2019-04-06 18:42:59 --> Severity: Notice --> Undefined index: sSearch E:\xampp7\htdocs\tahl\application\libraries\Datatables.php 72
ERROR - 2019-04-06 18:42:59 --> Severity: Notice --> Undefined index: iSortingCols E:\xampp7\htdocs\tahl\application\libraries\Datatables.php 93
ERROR - 2019-04-06 18:42:59 --> Query error: Unknown column '$' in 'field list' - Invalid query: SELECT `id`, `Date`, (SELECT clientName FROM clientList where Client=clientList.clientID) AS Client, `AccountSelection`, (SELECT FORMAT(Commission, 2)) as formatcom, CONCAT ($, formatcom) as Commission, `CommissionEdited`, `TradeType`, `Side`, `Symbol`, `Shares`, `AveragePrice`, `TotalCommission`, `SoftDollars`, `NetCommission`, `allocationToFR`, `fr`, `PotentialReferral`, `Notes`, (SELECT CONCAT(firstName, '', lastName) FROM users where TraderID=users.id LIMIT 1) AS TraderID
FROM `Trade`
ERROR - 2019-04-06 18:43:15 --> Severity: Notice --> Undefined index: iColumns E:\xampp7\htdocs\tahl\application\libraries\Datatables.php 44
ERROR - 2019-04-06 18:43:15 --> Severity: Notice --> Undefined index: iColumns E:\xampp7\htdocs\tahl\application\libraries\Datatables.php 52
ERROR - 2019-04-06 18:43:15 --> Severity: Notice --> Undefined index: sSearch E:\xampp7\htdocs\tahl\application\libraries\Datatables.php 72
ERROR - 2019-04-06 18:43:15 --> Severity: Notice --> Undefined index: iSortingCols E:\xampp7\htdocs\tahl\application\libraries\Datatables.php 93
ERROR - 2019-04-06 18:43:15 --> Query error: Unknown column 'formatcom' in 'field list' - Invalid query: SELECT `id`, `Date`, (SELECT clientName FROM clientList where Client=clientList.clientID) AS Client, `AccountSelection`, (SELECT FORMAT(Commission, 2)) as formatcom, CONCAT ('$', formatcom) as Commission, `CommissionEdited`, `TradeType`, `Side`, `Symbol`, `Shares`, `AveragePrice`, `TotalCommission`, `SoftDollars`, `NetCommission`, `allocationToFR`, `fr`, `PotentialReferral`, `Notes`, (SELECT CONCAT(firstName, '', lastName) FROM users where TraderID=users.id LIMIT 1) AS TraderID
FROM `Trade`
ERROR - 2019-04-06 18:43:39 --> Severity: Notice --> Undefined index: iColumns E:\xampp7\htdocs\tahl\application\libraries\Datatables.php 44
ERROR - 2019-04-06 18:43:39 --> Severity: Notice --> Undefined index: iColumns E:\xampp7\htdocs\tahl\application\libraries\Datatables.php 52
ERROR - 2019-04-06 18:43:39 --> Severity: Notice --> Undefined index: sSearch E:\xampp7\htdocs\tahl\application\libraries\Datatables.php 72
ERROR - 2019-04-06 18:43:39 --> Severity: Notice --> Undefined index: iSortingCols E:\xampp7\htdocs\tahl\application\libraries\Datatables.php 93
ERROR - 2019-04-06 18:43:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '1) AS TraderID
FROM `Trade`' at line 1 - Invalid query: SELECT `id`, `Date`, (SELECT clientName FROM clientList where Client=clientList.clientID) AS Client, `AccountSelection`, CONCAT ('$', (SELECT FORMAT(Commission, 2))) as Commission, `CommissionEdited`, `TradeType`, `Side`, `Symbol`, `Shares`, `AveragePrice`, `TotalCommission`, `SoftDollars`, `NetCommission`, `allocationToFR`, `fr`, `PotentialReferral`, `Notes`, (SELECT CONCAT(firstName, '', lastName) FROM users where TraderID=users.id 1) AS TraderID
FROM `Trade`
ERROR - 2019-04-06 18:43:47 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:43:48 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:45:47 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:45:47 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:46:28 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:46:29 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:47:03 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:47:04 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:47:26 --> Severity: Warning --> implode(): Invalid arguments passed E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 281
ERROR - 2019-04-06 18:50:13 --> Severity: Notice --> Undefined index: Commission E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 286
ERROR - 2019-04-06 18:50:13 --> Severity: Warning --> A non-numeric value encountered E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 311
ERROR - 2019-04-06 18:50:13 --> Severity: Warning --> A non-numeric value encountered E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 311
ERROR - 2019-04-06 18:51:12 --> Severity: Notice --> Undefined index: Commission E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 286
ERROR - 2019-04-06 18:51:12 --> Severity: Warning --> A non-numeric value encountered E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 311
ERROR - 2019-04-06 18:51:12 --> Severity: Warning --> A non-numeric value encountered E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 311
ERROR - 2019-04-06 18:51:36 --> Severity: Notice --> Undefined index: Commission E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 286
ERROR - 2019-04-06 18:51:36 --> Severity: Warning --> A non-numeric value encountered E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 311
ERROR - 2019-04-06 18:51:36 --> Severity: Warning --> A non-numeric value encountered E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 311
ERROR - 2019-04-06 18:53:30 --> Severity: Warning --> implode(): Invalid arguments passed E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 285
ERROR - 2019-04-06 18:54:41 --> Severity: Warning --> implode(): Invalid arguments passed E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 284
ERROR - 2019-04-06 18:55:21 --> Severity: Notice --> Undefined index: Commission E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 290
ERROR - 2019-04-06 18:55:21 --> Severity: Warning --> A non-numeric value encountered E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 315
ERROR - 2019-04-06 18:55:21 --> Severity: Warning --> A non-numeric value encountered E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 315
ERROR - 2019-04-06 18:56:50 --> Severity: Warning --> A non-numeric value encountered E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 314
ERROR - 2019-04-06 18:56:50 --> Severity: Warning --> A non-numeric value encountered E:\xampp7\htdocs\tahl\application\controllers\Dashboard.php 314
ERROR - 2019-04-06 18:59:33 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:59:33 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:59:38 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 18:59:39 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 19:00:12 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 19:00:12 --> 404 Page Not Found: Property/app-assets
ERROR - 2019-04-06 19:01:40 --> Query error: Unknown column 'status' in 'where clause' - Invalid query: SELECT `id`, `firstName`, `lastName`, `phoneNumber`, `email`, `position`
FROM `users`
WHERE `status` = 1
ORDER BY `firstName` ASC
 LIMIT 25
ERROR - 2019-04-06 19:04:37 --> Severity: Notice --> Undefined index: user E:\xampp7\htdocs\tahl\application\controllers\Site.php 58
