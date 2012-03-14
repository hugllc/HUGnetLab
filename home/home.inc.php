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
 * @link       https://dev.hugllc.com/index.php/Project:HUGnetLib
 */
if (!defined("_HUGNETLAB")) header("Location: ../index.php");

require_once HUGNET_INCLUDE_PATH."/containers/DeviceContainer.php";

?>
<form method="POST" action="<?php echo $url ?>">
<table>
    <tr>
        <td style="font-weight: bold;">Devices:</td>
        <td><input type="text" name="id" value="<?php print $html->args()->id; ?>" /></td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="run" value="Run"/></td>
    </tr>
</table>
</form>
<?php

$devices = explode(",", $html->args()->id);
$dev = new DeviceContainer();
foreach (array_keys($devices) as $key) {
    $did = hexdec($devices[$key]);
    DevicesTable::insertDeviceID(array("DeviceID" => $did, "GatewayKey" => 0xFFFF));
    $html->out("Getting configuration of ".sprintf("%06X", $did));
    $ret = $html->system()->device($did)->network()->config();
    if (!is_object($ret) || strlen($ret->Reply()) == 0) {
    //    $html->out("Could not contact device ".sprintf("%06X", $devices[$key])));
    } else {
        $dev->fromAny($ret->Reply());
        $dev->updateRow();
    }
}
?>
<table>
<?php

?>
</table>
