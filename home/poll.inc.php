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

$sensors = 9;

?>
<form method="POST" action="<?php echo $url ?>">
<table>
    <tr>
        <th>Device:</th>
        <td><input type="text" name="id" value="<?php print $html->args()->id; ?>" /></td>
    </tr>
    <tr>
        <th>Packet Count:</td>
        <td><span id="packetCount">0</span></td>
    </tr>
    <tr>
        <th>Record Count:</td>
        <td><span id="recordCount">0</span></td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="run" value="Start"/></td>
    </tr>
</table>
</form>
<?php

$device = hexdec($html->args()->id);
if ($html->args()->id == "") {
    return;
}
$dev = new DeviceContainer();
$dev->getRow($device);
if (empty($dev->HWPartNum)) {
    DevicesTable::insertDeviceID(array("DeviceID" => $device, "GatewayKey" => 0xFFFF));
    $html->out("Getting configuration of ".sprintf("%06X", $device));
    $ret = $html->system()->device($device)->network()->config();
    if (!is_object($ret) || strlen($ret->Reply()) == 0) {
    //    $html->out("Could not contact device ".sprintf("%06X", $devices[$key])));
        print "Failed to find the device";
        return;
    } else {
        $dev->fromAny($ret->Reply());
        $dev->updateRow();
    }
}
?>
<table>
    <tr>
        <th>Date</th>
        <th>Index</th>
<?php
for ($i = 0; $i < $sensors; $i++) {
    print "        <th>".$dev->sensor($i)->unitType."<br/>(".$dev->sensor($i)->storageUnit.")</th>";
}
?>
    </tr>
    <tbody id="dataTable" style="overflow: scroll; max-height: 800px;">
    </tbody>
</table>
<script lang="JavaScript">
    var k = 0;
    var dataIndex = 0;
    var packetCount = 0;
    var recordCount = 0;
    function poll()
    {
        $.get("ajax/poll.php?id=<?php print dechex($dev->id); ?>",
            function(data) {
                if (data.DataIndex != dataIndex) {
                    k = 1 - k;
                    $('#dataTable').prepend(
                                    '<tr><td class="row'+k+'">' + data.Date + "</td>"
                                + '<td class="row'+k+'">' + data.DataIndex + "</td>"
                            <?php for ($i = 0; $i < $sensors; $i++): ?>
                                + '<td class="row'+k+'">' + data.Data<?php print $i; ?> + "</td>"
                            <?php endfor; ?>
                                + "</tr>");
                    recordCount++;
                    $('#recordCount').text(recordCount);
                }
                dataIndex = data.DataIndex;
                packetCount++;
                $('#packetCount').text(packetCount);
                poll();
            }, "json");
    }
    $(document).ready(function(){
        poll();
    });
</script>

