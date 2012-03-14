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
//$filedir = realpath(dirname(__FILE__));
$filedir = dirname(__FILE__);
if (!isset($basedir)) $basedir = $filedir;

$template = $_REQUEST["template"];
require_once $filedir."/includes/network.php";
/*
if (mobileUA()) {
    $template = "mobile";
}
*/
$pageStartTime = microtime(true);
define("_HUGNETLAB", true);
define("HUGNETLAB_VERSION", trim(file_get_contents(dirname(__FILE__)."/VERSION.TXT")));

$uname = posix_uname();
$host = trim($uname['nodename']);

require_once $filedir."/includes/hugnet.php";

$task = $html->args()->task;
$option = $html->args()->option;

$menu_include = $filedir."/home/menu.inc.php";
if (file_exists($filedir."/".$option."/".$task.".inc.php")) {
    $include = $filedir."/".$option."/".$task.".inc.php";
} else {
    $include = $filedir."/".$option."/home.inc.php";
}
if (file_exists($filedir."/".$option."/menu.inc.php")) {
    $menu_include = $filedir."/".$option."/menu.inc.php";
}

ob_start();
include $include;
$body = ob_get_clean();


if (trim(strtolower($template)) == "bare") {
    print $body;
} else {
    $url = $_SERVER['SCRIPT_NAME']."?option=$option&task=$task";

    include $menu_include;
    $optionmenu = array(
    );
    if (!file_exists($filedir."/templates/".$template.".php")) $template = "default";
    include $filedir."/templates/".$template.".php";
}
?>

