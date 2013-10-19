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
define("HUGNETLAB_VERSION", trim(@file_get_contents("HUGnetLab/VERSION.TXT", true)));
define("HUGNETLIB_VERSION", trim(@file_get_contents("HUGnetLib/VERSION.TXT", true)));

require_once "HUGnetLab/Mustache.php";

$action = $_REQUEST["action"];
$task   = $_REQUEST["task"];
$format = strtolower($_REQUEST["format"]);
$id     = strtoupper($_REQUEST["id"]);


if (function_exists("posix_uname")) {
    $uname = posix_uname();
    $on = " on ".trim($uname['nodename']);
}

$config = array(
    "template" => "default",
    "url" => "http://localhost/HUGnetLib/HUGnetLibAPI.php",
    "title" => "HUGnetLab™".$on,

);

$error = null;

$tasks = array(
    "device" => array("get", "list"),
    "history" => array("get", "last"),
);

$file = dirname(__FILE__)."/configuration.ini";
if (file_exists($file)) {
    $config = array_merge($config, (array)parse_ini_file($file, true));
}

if (is_array($tasks[$task]) && in_array($action, $tasks[$task])) {
    $url = $config["url"]."?".http_build_query($_GET);
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
} else {

    $template_dir = dirname(__FILE__)."/HUGnetLab/template/".$config["template"];
    if (!file_exists($template_dir."/index.php")) {
        $template_dir = dirname(__FILE__)."/HUGnetLab/template/default";
    }

    $mainTemplate = get_file($template_dir."/index.php");

    $tData = array(
        "HUGnetLabVersion" => HUGNETLAB_VERSION,
        "host" => trim($uname['nodename']),
        "title" => $config["title"],
        "error" => $error,
    );
    if (defined("HUGNETLIB_VERSION")) {
        $tData["HUGnetLibVersion"] = HUGNETLIB_VERSION;
    }
    $plugins = array(
        "tests", "config", "view", "devices", "datacollectors", "serverconfig",
        "outputs"
    );
    foreach ($plugins as $name) {
        $value = get_file("HUGnetLab/plugins/".$name.".php");
        $value = trim($value);
        if (!empty($value)) {
            $tData[$name] = $value;
        }
    }
    $main = new Mustache($mainTemplate);

    $tData["pageDate"] = date("r");
    $tData["pageTime"] = round(microtime(true) - $pageStartTime, 4);
    print $main->render(null, $tData);
}

/**
 * This gets the content of a file
 *
 * @param string $name The name of the file
 *
 * @return string The contents of the file
 */
function get_file($name)
{
    ob_start();
    ob_clean();
    @include $name;
    $return = ob_get_contents();
    ob_end_clean();
    return (string)$return;
}


?>

