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
    <tbody id="devParameters">
    <tr><th colspan="2">Parameters</th>
    <tr><th class="leftproperty">Last Contact</th><td id="LastContact"></td></tr>
    <tr><th class="leftproperty">Last Poll</th><td id="LastPoll"></td></tr>
    <tr><th class="leftproperty">Last History</th><td id="LastHistory"></td></tr>
    </tbody>
    <tbody>
    <tr><th class="leftproperty">Actions</th><td id="actions"></td>
    </tbody>
    </table>
<table id="deviceSensors">
    <tbody id="devSensorProperties">
    </tbody>
</table>
</div>
</form>
<div><span style="font-weight: bold;">Last Firmware Check:</span> <span id="lastFirmwareCheck">Never</span></div>


<script lang="JavaScript">
    var k = 0;
    var dataIndex = 0;
    var packetCount = 0;
    var recordCount = 0;
    var devices = new Array();

    /**
     * Shows the list of endpoints
     *
     * @return null
     */
    function showList()
    {
        $('div#devView').hide();
        $('div#listView').show();
    }
    /**
     * Shows a single device
     *
     * @param id The id of the device to show
     *
     * @return null
     */
    function showDevice(id)
    {
        $('div#devView').show();
        $('div#listView').hide();
        $('span#devHeader').html(devices[id].DeviceID);
        setDevice(devices[id]);
    }

    /**
     * Sets up the single device table with the data given
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function setDevice(data)
    {
        $('table#device tbody#devProperties td').each(function() {
            var key = $(this).attr('id');
            if (data[key] == undefined) {
                $(this).html("-");
            } else {
                $(this).html(data[key]);
            }
        });
        if (data['params'] != undefined) {
            $('table#device tbody#devParameters td').each(function() {
                var key = $(this).attr('id');
                if (data['params'][key] == undefined) {
                    $(this).html("-");
                } else {
                    $(this).html(data['params'][key]);
                }
            });
        }
        var actions = '<button id="RefreshDev" type="button" class="refresh" lang="JavaScript" onclick="getConfigDev(' + data.id + ');">Refresh</button>';
        actions = actions + markupFirmware(data);
        $('table#device tbody td#actions').html(actions);
    }
    /**
     * Sets up the single device table with the data given
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function markupFirmware(data)
    {
        var firmware = data.FWPartNum + ' ' + data.FWVersion;
        if (data.update != undefined) {
            firmware = firmware + '<br /><button id="UpdateFirmware' + data.id + '" type="button" class="show" lang="JavaScript" onclick="updateFirmware(' + data.id + ', \'' + data.update + '\');">Update to ' + data.update + '</button>';
        }
        return firmware;
    }
    /**
     * Gets infomration about a device.  This is retrieved from the database only.
     *
     * @param id The id of the device to get
     *
     * @return null
     */
    function getDevice(id)
    {
        $.get("<?php print AJAX_GETDEVICE; ?>&id="+id.toString(16), saveRow, "json");
    }
    /**
     * Gets infomration about a device.  This is retrieved directly from the device
     *
     * This function is for use of the device list
     *
     * @param id The id of the device to get
     *
     * @return null
     */
    function getConfig(id)
    {
        $('#Refresh'+ id).html("Working...");
        $.get("<?php print AJAX_CONFIG; ?>&id="+id.toString(16), saveRow, "json");
    }
    /**
     * Gets infomration about a device.  This is retrieved directly from the device.
     *
     * This function is for the use of the single device table.
     *
     * @param id The id of the device to get
     *
     * @return null
     */
    function getConfigDev(id)
    {
        $('#RefreshDev').html("Working...");
        $.get("<?php print AJAX_CONFIG; ?>&id="+id.toString(16), saveDevRow, "json");
    }
    /**
     * Saves the json data returned from getDevice.php and config.php
     *
     * This updates the single device table as well as the list
     *
     * @param data The data returned
     *
     * @return null
     */
    function saveDevRow(data)
    {
        saveRow(data);
        setDevice(data);
    }
    /**
     * Saves the json data returned from getDevice.php and config.php
     *
     * This updates the list only
     *
     * @param data The data returned
     *
     * @return null
     */
    function saveRow(data)
    {
        devices[data.id] = data;
        if ($('table#devices tbody tr#dev'+data.id).length == 0) {
            k = 1 - k;
            $('table#devices tbody').append('<tr id="dev'+data.id+'" class="row'+k+'"></tr>');
        }
        var actions = '<button id="Refresh' + data.id + '" type="button" class="refresh" lang="JavaScript" onclick="getConfig(' + data.id + ');">Refresh</button>'
                    + '<button id="Show' + data.id + '" type="button" class="show" lang="JavaScript" onclick="showDevice(' + data.id + ');">Show</button>';
        var text = '<td class="Actions">' + actions + '</td>';
        text = text + '<td class="id">' + data.id + '</td>'
            + '<td class="DeviceID">' + data.DeviceID + '</td>'
            + '<td class="Hardware">' + data.HWPartNum + '</td>'
            + '<td class="Firmware">' + markupFirmware(data) + '</td>';

        $('#Refresh'+data.id).button();

        $('table#devices tr#dev'+data.id).html(text);
        $('table#devices').trigger("update");
    }
    /**
     * Initializes the device list
     *
     * @return null
     */
    function initDevices()
    {
        $.get("<?php print AJAX_GETDEVICE; ?>", function (data) {
            for (dev in data) {
                getDevice(parseInt(data[dev]));
            }
        }, "json");
    }

    /**
     * Initializes the device list
     *
     * @return null
     */
    function checkFirmware()
    {
        $.get("<?php print AJAX_FIRMWARE; ?>", function (data) {
            var d = new Date();
            $("#lastFirmwareCheck").html(d.toLocaleDateString()+' '+d.toLocaleTimeString());
            $("#lastFirmwareCheck").show();
            setTimeout('checkFirmware()', 86400000);
            initDevices();
        }, "json");
    }

        /**
     * Initializes the device list
     *
     * @return null
     */
    function updateFirmware(id, version)
    {
        $('#UpdateFirmware'+ id).html("Updating...");
        $.get("<?php print AJAX_UPDATEFIRMWARE; ?>&id="+id.toString(16)+"&version="+version, saveRow, "json");
    }


    $(document).ready(function(){
        initDevices();
        checkFirmware();
        $("table#devices").tablesorter({sortList: [[1,0]]});
    });
</script>

