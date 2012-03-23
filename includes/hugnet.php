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
require_once 'HUGnetLib/hugnet.inc.php';
require_once HUGNET_INCLUDE_PATH."/ui/HTML.php";

if (!isset($_SESSION["HUGnet"])) {
    $_SESSION["HUGnet"] = array();
}

$args = \HUGnet\ui\HTMLArgs::factory(
    $_REQUEST,
    count($_REQUEST),
    array(
        "task" => array("name" => "task", "type" => "string", "default" => "home"),
        "option" => array(
            "name" => "option", "type" => "string", "default" => "home"
        ),
        "id" => array("name" => "DeviceID", "type" => "string"),
        "dev" => array(
            "name" => "device", "type" => "string", "default" => "/dev/ttyUSB0"
        ),
        "sock" => array(
            "name" => "socket", "type" => "string", "default" => "/tmp/HUGnetRouter"
        ),
    )
);
$config = $args->config();
/*
$config["network"]["default"] = array(
    "driver" => "Serial",
    "location" => $args->dev,
);
*/
$config["network"]["default"] = array(
    "driver" => "Socket",
    "type" => AF_UNIX,
    "location" => $args->socket,
);
$config["servers"] = array(
    array(
        "driver" => "sqlite",
        "file"   => sys_get_temp_dir()."/HUGnetLab.sq3",
        "group"  => "default",
        "filePerm" => 0666,
    ),
);
$html = \HUGnet\ui\HTML::factory($config, $args);
