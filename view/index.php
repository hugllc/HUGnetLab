<?php
/**
 * Main index
 *
 * <pre>
 * CoreUI is a user interface for the HUGnet cores.
 * Copyright (C) 2012 Hunt Utilities Group, LLC
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * </pre>
 *
 * @category   UI
 * @package    CoreUI
 * @subpackage Main
 * @author     Scott Price <prices@hugllc.com>
 * @copyright  2007 Hunt Utilities Group, LLC
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    SVN: $Id$
 * @link       https://dev.hugllc.com/index.php/Project:HUGnetLib
 */
$pageStartTime = microtime(true);
define("_HUGNETLAB", true);
define("HUGNETLAB_VERSION", trim(file_get_contents("HUGnetLab/VERSION.TXT", true)));
define("HUGNETLIB_VERSION", trim(file_get_contents("HUGnetLib/VERSION.TXT", true)));

$action = $_REQUEST["action"];
$task   = $_REQUEST["task"];
$format = strtolower($_REQUEST["format"]);
$id     = strtoupper($_REQUEST["id"]);

$tasks = array(
    "device" => array("get", "ids", "getall"),
    "sensor" => array("get", "ids"),
    "history" => array(""),
);
$tempDir = "default";

if (file_exists(dirname(__FILE__)."/configuration.php")) {
    include dirname(__FILE__)."/configuration.php";
} else {
    die("No configuration found");
}

if (is_array($tasks[$task]) && in_array($action, $tasks[$task])) {
    $url .= "?".http_build_query($_GET);
    $params = array(
        'http' => array(
            'method' => 'POST',
            'content' => http_build_query($_POST)."\n",
        )
    );
    $ctx = stream_context_create($params);
    $response = file_get_contents($url, false, $ctx);
    if (($task === "history") && ($format === "csv")) {
        header('Content-type: text/csv');
        header(
            'Content-disposition: attachment;'
            .'filename=HUGnetLab.'.$id.'.csv'
        );
    } else {
        header('Content-type: application/json');
    }
    print $response;

    unset($response);
    unset($params);
    unset($ctx);
} else if (is_null($task) && is_null($action)) {
    include_once "HUGnetLab/Mustache.php";
    ob_start();
    ob_clean();
    include dirname(__FILE__)."/template/".$tempDir."/index.php";
    $mainTemplate = ob_get_contents();
    ob_end_clean();

    if (function_exists("posix_uname")) {
        $uname = posix_uname();
    }
    $tData = array(
        "HUGnetLabVersion" => HUGNETLAB_VERSION,
        "HUGnetLibVersion" => HUGNETLIB_VERSION,
        "host" => trim($uname['nodename']),
    );

    $main = new Mustache($mainTemplate);



    $tData["pageDate"] = date("r");
    $tData["pageTime"] = round(microtime(true) - $pageStartTime, 4);
    print $main->render(null, $tData);
}
?>

