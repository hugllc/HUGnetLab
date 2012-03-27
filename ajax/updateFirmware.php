<?php
/**
 * Setup Home
 *
 * <pre>
 * CoreUI is a user interface for the HUGnet cores.
 * Copyright (C) 2007 Hunt Utilities Group, LLC
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
 * @subpackage Setup
 * @author     Scott Price <prices@hugllc.com>
 * @copyright  2007 Hunt Utilities Group, LLC
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    SVN: $Id$
 * @link       https://dev.hugllc.com/index.php/Project:HUGnetLab
 */


if (!defined("_HUGNETLAB")) header("Location: ../index.php");

$did = hexdec($html->args()->id);

if (empty($did)) {
    return;
}
$device = &$html->system()->device($did);

$device->firmware()->set("HWPartNum", $device->get("HWPartNum"));
$FWPartNum = $device->get("FWPartNum");
if ($FWPartNum === "0039-38-02-C") {
    $FWPartNum = "0039-38-01-C";
}
$device->firmware()->set("FWPartNum", $FWPartNum);
$device->firmware()->set("RelStatus", \FirmwareTable::DEV);
$device->firmware()->getLatest();

$firmware =& $device->firmware();
$device->network()->loadFirmware($firmware);

$pkt = &$device->network()->config();
if (strlen($pkt->reply()) > 0) {
    $device->config()->decode($pkt->reply());
    $device->setParam("LastContact", date("Y-m-d H:i:s"));
    $device->store(true);
}
print $device->json();

?>