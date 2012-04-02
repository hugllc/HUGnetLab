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
<div id="listView" style="display: block;">
<h2>Device List</h2>
<form id="devicesForm" method="POST" action="javascript:void(0);">
<div>
    <input type="text" id="newDevice" value="" />
    <button type="button" lang="JavaScript" onclick="addDevice();">Add Device</button>
</div>
<table id="devices" class="tablesorter">
    <thead>
    <tr id="devicesHead">
        <th class="{sorter: false}" id="actions">Actions</th>
        <th class="{sorter: 'numeric'}" id="id">Serial #</th>
        <th class="{sorter: 'text'}" id="DeviceID">DeviceID</th>
        <th class="{sorter: 'text'}" id="HWPartNum">Hardware</th>
        <th class="{sorter: 'text'}" id="Firmware">Firmware</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>
</form>
<div id="devView" style="display: none;">
<button id="backToList" type="button" class="backToList" lang="JavaScript" onclick="showList();">Back To List</button>
<h2>Device: <span id="devHeader"></span></h2>
<form id="deviceForm" method="POST" action="javascript:void(0);">
<table id="device">
    <tbody id="devProperties">
    <tr><th colspan="2">Properties</th>
    <tr><th class="leftproperty">Serial #</th><td id="id"></td></tr>
    <tr><th class="leftproperty">DeviceID</th><td id="DeviceID"></td></tr>
    <tr><th class="leftproperty">DeviceName</th><td id="DeviceName"></td></tr>
    <tr><th class="leftproperty">DeviceLocation</th><td id="DeviceLocation"></td></tr>
    <tr><th class="leftproperty">DeviceJob</th><td id="DeviceJob"></td></tr>
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
    <tr><th class="leftproperty">Last Modified</th><td id="LastModified"></td></tr>
    </tbody>
    <tbody>
    <tr><th class="leftproperty">Actions</th><td id="actions"></td>
    </tbody>
    </table>
<table id="deviceSensors">
    <thead>
    <tr>
        <th colspan="4">Sensors</th>
    </tr>
    <tr id="deviceSensorHead">
        <th id="sensor">#</th>
        <th id="location">Location</th>
        <th id="type">Type</th>
        <th id="extraDefault">Parameters</th>
        <th id="units">Units</th>
    </tr>
    </thead>
    <tbody id="devSensorData">
    </tbody>
</table>
</div>
</form>
<div><span style="font-weight: bold;">Last Firmware Check:</span> <span id="lastFirmwareCheck">Never</span></div>
<div id="testDiv"></div>
<script lang="JavaScript">
    var k = 0;
    var dataIndex = 0;
    var packetCount = 0;
    var recordCount = 0;
    var devices = new Array();

    $('#deviceForm').submit(function() {
        // Get all the forms elements and their values in one step
        var id = parseInt($('#device #id').text());
        $('#SaveDev').text('Working...');
        $.post(
            "index.php?option=ajax&task=postDevice&id="+id.toString(16),
            $("#deviceForm").serialize(),
            saveDevRow,
            "json"
        );
        /*
        $.post(
            "index.php?option=ajax&task=postDevice&id="+id.toString(16),
            $("#deviceForm").serialize(),
            function(data) {
                $("#testDiv").append('<pre>'+data+'</pre>');
            },
            "text"
        );
        */
        return false;
    });

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
                $(this).html(editDeviceValue(data, key));
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
        if (data['sensors'] != undefined) {
            $('#deviceSensors #devSensorData').html('');
            for (i = 0; i < data['totalSensors']; i++) {
                if (data['sensors'][i] != undefined) {
                    /* Run through the header */
                    var text = '<tr id="sensor' + i + '" class="row'+(i & 1)+'">';
                    $('#deviceSensors tr#deviceSensorHead th').each(function() {
                        var key = $(this).attr('id');
                        text += '<td class="' + key + '">';
                        if (data['sensors'][i][key] == undefined) {
                            text += '-';
                        } else {
                            text += editSensorValue(data['sensors'][i], key, i);
                        }
                        text += '</td>';
                    });
                    text += '</tr>';
                    $('#deviceSensors #devSensorData').append(text);
                }
            }
        }
        var actions = '<button id="RefreshDev" type="button" class="refresh" lang="JavaScript" onclick="getConfigDev(' + data.id + ');">Refresh</button>';
        actions += '<button id="SaveDev" type="submit" class="submit" lang="JavaScript">Save</button>';
        //actions = actions + markupFirmware(data);
        $('table#device tbody td#actions').html(actions);
    }
    /**
     * Sets up the single device table with the data given
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function editDeviceValue(dData, key)
    {
        var text = dData[key];
        var field = 'device['+key+']';
        if ((key == 'DeviceName')
            || (key == 'DeviceJob')
            || (key == 'DeviceLocation')
        ) {
            text = '<input type="text" name="'+field+'" '
                 + 'value="' + dData[key] + '" />';
        }
        return text;
    }
    /**
     * Sets up the single device table with the data given
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function editSensorValue(sData, key, index)
    {
        var text = sData[key];
        var field = 'sensors['+index+']['+key+']';
        if (key == 'location') {
            text = '<input type="text" name="'+field+'" '
                 + 'value="' + sData[key] + '" />';
        } else if (key == 'type') {
            if (sData['otherTypes'].length == undefined) {
                text  = '<select name="'+field+'" >';
                for (q in sData['otherTypes'])
                {
                    text += '<option value="'+q+'"';
                    if (q == sData['type']) {
                        text += ' selected="selected" ';
                    }
                    text += '>'+sData['otherTypes'][q]+'</option>';
                }
                text += '</select>';
            }
        } else if (key == 'extraDefault') {
            text = '';
            for (p in sData[key]) {
                text += editExtraValue(sData, p, index);
            }
        }
        return text;
    }
    /**
     * Sets up the single device table with the data given
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function editExtraValue(sData, key, index)
    {
        var etext;
        var efield = 'sensors['+index+'][extra]['+key+']';
        var evalue;
        if ((sData["extra"] == undefined)
            || (sData["extra"][key] == undefined)
        ) {
            evalue = sData["extraDefault"][key];
        } else {
            evalue = sData["extra"][key];
        }
        var type = sData["extraValues"][key];
        etext  = '<div class="nowrap">';
        etext += '<span class="bold">'+sData["extraText"][key]+':</span>';
        if ((parseFloat(type) == parseInt(type)) && !isNaN(type)) {
            etext += '<input type="text" name="'+efield+'" '
                 + 'value="' + evalue + '" size="'+(type+2)+'" maxlength="'+type+'"/>';
        } else if (type instanceof Array) {
            etext += '<select name="'+field+'" >';
            for (q in type)
            {
                etext += '<option value="'+q+'"';
                if (q == evalue) {
                    etext += ' selected="selected" ';
                }
                etext += '>'+type[q]+'</option>';
            }
            etext += '</select>';
        } else {
            etext += evalue;
        }
        etext += '</div>';
        return etext;
    }
    /**
     * Sets up the single device table with the data given
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function saveDev()
    {

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
        if ((data.update != undefined) || (data.bootloader)) {
            firmware += '<br /><button id="UpdateFirmware' + data.id + '" type="button" class="show" lang="JavaScript" onclick="updateFirmware(' + data.id + ', \'' + data.update + '\');">';
            if (data.update == undefined) {
                firmware += 'Load Program';
            } else {
                firmware += 'Update to ' + data.update;
            }
            firmware += '</button>';
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
        devices[data['id']] = data;
        /* Insert the row if it is not already there */
        if ($('table#devices tbody tr#dev'+data['id']).length == 0) {
            k = 1 - k;
            $('table#devices tbody').append('<tr id="dev'+data['id']+'" class="row'+k+'"></tr>');
        }
        /* These are two special fields we are adding */
        data['actions'] = '<button id="Refresh' + data['id'] + '" type="button" class="refresh" lang="JavaScript" onclick="getConfig(' + data['id'] + ');">Refresh</button>'
                    + '<button id="Show' + data['id'] + '" type="button" class="show" lang="JavaScript" onclick="showDevice(' + data['id'] + ');">Show</button>';
        data['Firmware'] = markupFirmware(data);

        /* Run through the header */
        var text = '';
        $('table#devices tr#devicesHead th').each(function() {
            var key = $(this).attr('id');
            text += '<td class="' + key + '">';
            if (data[key] == undefined) {
                text += '-';
            } else {
                text += data[key];
            }
            text += '</td>';
        });
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

    /**
     * Initializes the device list
     *
     * @return null
     */
    function addDevice()
    {
        var id = parseInt($('#newDevice').val(), 16);
        if (id > 0) {
            $.get("<?php print AJAX_CONFIG; ?>&id="+id.toString(16), saveRow, "json");
        }
        $('#newDevice').val("");
    }


    $(document).ready(function(){
        initDevices();
        checkFirmware();
        $("table#devices").tablesorter({sortList: [[1,0]]});
    });
</script>

