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

require_once "HUGnetLab/Mustache.php";
require_once "HUGnetLab/hugnet.php";

$tempfile = "default";

$main = new Mustache(
    file_get_contents(
        dirname(__FILE__)."/HUGnetLab/template/".$tempfile."/index.html"
    )
);

$tData = array(
    "HUGnetLabVersion" => HUGNETLAB_VERSION,
);


$uname = posix_uname();
$tData["host"] = trim($uname['nodename']);

require_once "HUGnetLab/hugnet.php";


$tData["pageDate"] = date("r");
$tData["pageTime"] = round(microtime(true) - $pageStartTime, 4);
$tData["debug"] = \HUGnet\VPrint::debug();
print $main->render(null, $tData);

?>

