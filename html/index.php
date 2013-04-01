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

require_once "HUGnetLab/Mustache.php";
require_once "HUGnetLab/hugnet.php";

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

$template_dir = dirname(__FILE__)."/HUGnetLab/template/".$config["template"];
if (!file_exists($template_dir."/index.php")) {
    $template_dir = dirname(__FILE__)."/HUGnetLab/template/default";
}

ob_start();
ob_clean();
include $template_dir."/index.php";
$mainTemplate = ob_get_contents();
ob_end_clean();

$tData = array(
    "HUGnetLabVersion" => HUGNETLAB_VERSION,
    "HUGnetLibVersion" => HUGNETLIB_VERSION,
    "host" => trim($uname['nodename']),
    "title" => $config["title"],
    "error" => $error,
);

$main = new Mustache($mainTemplate);

$tData["pageDate"] = date("r");
$tData["pageTime"] = round(microtime(true) - $pageStartTime, 4);
print $main->render(null, $tData);

?>

