<?php
/**
 * Setup Home
 *
 * <pre>
 * HUGnetLab is the user interface for the HUGnetLab Project
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
 * @package    HUGnetLab
 * @subpackage Setup
 * @author     Scott Price <prices@hugllc.com>
 * @copyright  2012 Hunt Utilities Group, LLC
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    SVN: $Id$
 * @link       https://dev.hugllc.com/index.php/Project:HUGnetLab
 */
if (!defined("_HUGNETLAB")) header("Location: ../index.php");

require_once HUGNET_INCLUDE_PATH."/containers/DeviceContainer.php";
/*
$dev = new DeviceContainer();
$dev->getRow(hexdec($html->args()->id));
*/
$dev = &$html->system()->device(hexdec($html->args()->id));

$sensors = 9;

$display = array(
    "Serial #" => $dev->get("id"),
    "ID" => $dev->get("DeviceID"),
    "Name" => '<input type="text" name="DeviceName" value="'.$dev->get("DeviceName").'" />',
    "Job" => '<input type="text" name="DeviceJob" value="'.$dev->get("DeviceJob").'" />',
    "Active Sensors" => '<input type="text" size="5" name="ActiveSensors" value="'.$dev->get("ActiveSensors").'" />',
);
?>
<h2>Device <?php print $dev->get("DeviceID").":  ".$dev->get("DeviceName"); ?></h2>

<form method="POST" action="<?php echo $url ?>">
<table>
<?php foreach ($display as $key => $value): ?>
    <tr>
        <th class="leftHeader"><?php print $key; ?></th>
        <td><?php print $value; ?></td>
    </tr>
<?php endforeach; ?>
    <tr>
        <td colspan="2"><input type="submit" name="run" value="Start"/></td>
    </tr>
</table>
</form>
<?php

?>

