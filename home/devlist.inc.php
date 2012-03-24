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
$devices = array(0x1008, 0xFE, 0x67);



?>
<h2>Device List</h2>
<form method="POST" action="<?php echo $url ?>">
<table id="devices" class="tablesorter">
    <thead>
    <tr>
        <th class="{sorter: false}">Actions</th>
        <th class="{sorter: 'numeric'}">Serial #</th>
        <th class="{sorter: 'text'}">DeviceID</th>
        <th class="{sorter: 'text'}">Hardware</th>
        <th class="{sorter: 'text'}">Firmware</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</form>
<script lang="JavaScript">
    var k = 0;
    var dataIndex = 0;
    var packetCount = 0;
    var recordCount = 0;
    function getDevice(id)
    {
        $.get("ajax/getDevice.php?id="+id.toString(16), saveRow, "json");
    }
    function getConfig(id)
    {
        $('#Refresh'+ id).html("Working...");
        $.get("ajax/config.php?id="+id.toString(16), saveRow, "json");
    }
    function saveRow(data)
    {
        if ($('table#devices tbody tr#dev'+data.id).length == 0) {
            k = 1 - k;
            $('table#devices tbody').append('<tr id="dev'+data.id+'" class="row'+k+'"></tr>');
        }
        $('table#devices tr#dev'+data.id).html(
            '<td class="Actions">'
               + '<button id="Refresh' + data.id + '" type="button" class="refresh" lang="JavaScript" onclick="getConfig(' + data.id + ');">Refresh</button>'
            + '</td>'
            + '<td class="id">' + data.id + '</td>'
            + '<td class="DeviceID">' + data.DeviceID + '</td>'
            + '<td class="Hardware">' + data.HWPartNum + '</td>'
            + '<td class="Firmware">' + data.FWPartNum + ' ' + data.FWVersion + '</td>'
        );
        $('table#devices').trigger("update");
    }
    $(document).ready(function(){
        <?php foreach($devices as $dev): ?>
            getDevice(<?php print $dev; ?>);
        <?php endforeach; ?>
        $("#devices").tablesorter({sortList: [[1,0]], headers: {0: {sorter: false}}});
    });
</script>

