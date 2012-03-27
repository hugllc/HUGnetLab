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

$option = $html->args()->option;

if (file_exists($filedir."/".$option."/menu.inc.php")) {
    $menu_include = $filedir."/".$option."/menu.inc.php";
} else {
    $menu_include = $filedir."/home/menu.inc.php";
    $option = "home";
}


if (strtolower($option) === "ajax") {
    $task = $html->args()->task;
    if (file_exists($filedir."/ajax/".$task.".php")) {
        include $filedir."/ajax/".$task.".php";
    }
} else {
    include $menu_include;

    $menuitems = array();
    $bodyitems = array();
    $index = 1;
    $url = $_SERVER['SCRIPT_NAME']."?option=$option";
    foreach ((array)$taskmenu as $name => $item) {
        $menuitems[$index] = '<li><a href="#tabs-'.$index.'">'.$name.'</a></li>';
        ob_start();
        include $filedir."/".$option."/".$item.".inc.php";
        $bodyitems[$index] = "<div id=\"tabs-".$index."\">\n".ob_get_clean()."\n</div>\n";
        $index++;
    }
    $body  = "<div id=\"tabs\">\n<ul>\n".implode("\n", $menuitems)."\n</ul>\n";
    $body .= implode("\n", $bodyitems)."\n</div>\n";
    $header = "<script>\n\$(function(){\n\$('#tabs').tabs();\n});\n</script>";


    if (!file_exists($filedir."/templates/".$template."/index.php")) $template = "default";
    include $filedir."/templates/".$template."/index.php";
}
?>

