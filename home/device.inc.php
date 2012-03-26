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
<form method="POST" action="<?php echo $url ?>">
<div id="listView" style="display: block;">
<h2>Device List</h2>
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
</div>
<div id="devView" style="display: none;">
<button id="backToList" type="button" class="backToList" lang="JavaScript" onclick="showList();">Back To List</button>
<h2>Device: <span id="devHeader"></span></h2>
<table id="device">
    <tbody id="devProperties">
    <tr><th colspan="2">Properties</th>
    <tr><th class="leftproperty">Serial #</th><td id="id"></td></tr>
    <tr><th class="leftproperty">DeviceID</th><td id="DeviceID"></td></tr>
    <tr><th class="leftproperty">RawSetup</th><td id="RawSetup"></td></tr>
    <tr><th class="leftproperty">HWPartNum</th><td id="HWPartNum"></td></tr>
    <tr><th class="leftproperty">FWPartNum</th><td id="FWPartNum"></td></tr>
    <tr><th class="leftproperty">FWVersion</th><td id="FWVersion"></td></tr>
    <tr><th class="leftproperty">Physical Sensors</th><td id="physicalSensors"></td></tr>
    <tr><th class="leftproperty">Virtual Sensors</th><td id="virtualSensors"></td></tr>
    <tr><th class="leftproperty">Active Sensors</th><td id="ActiveSensors"></td></tr>
    </tbody>
</table>
</div>
</form>
<script lang="JavaScript">
    var k = 0;
    var dataIndex = 0;
    var packetCount = 0;
    var recordCount = 0;
    var devices = new Array();
    function showList()
    {
        $('div#devView').hide();
        $('div#listView').show();
    }
    function showDevice(id)
    {
        $('div#devView').show();
        $('div#listView').hide();
        $('span#devHeader').html(devices[id].DeviceID);
        setDevice(devices[id]);
    }

    function setDevice(data)
    {
        for (key in data) {
            if ($('table#device tbody#devProperties td#'+key).length > 0) {
                $('table#device tbody#devProperties td#'+key).html(data[key]);
            }
        }
    }

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
        devices[data.id] = data;
        if ($('table#devices tbody tr#dev'+data.id).length == 0) {
            k = 1 - k;
            $('table#devices tbody').append('<tr id="dev'+data.id+'" class="row'+k+'"></tr>');
        }
        $('table#devices tr#dev'+data.id).html(
            '<td class="Actions">'
               + '<button id="Refresh' + data.id + '" type="button" class="refresh" lang="JavaScript" onclick="getConfig(' + data.id + ');">Refresh</button>'
               + '<button id="Show' + data.id + '" type="button" class="show" lang="JavaScript" onclick="showDevice(' + data.id + ');">Show</button>'
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

