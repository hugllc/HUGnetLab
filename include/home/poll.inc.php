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
<!-- These are the scripts we need -->
<link rel="stylesheet" href="includes/jqplot/jquery.jqplot.css" />
<script src="includes/jqplot/jquery.jqplot.js" type="text/javascript"></script>
<script type="text/javascript" src="includes/jqplot/plugins/jqplot.meterGaugeRenderer.min.js"></script>

<form method="POST" action="javascript:void(0);">
<table style="float: right;">
    <tr>
        <td><span id="packetCount">0</span></td>
        <th class="rightproperty">Packet Count</td>
    </tr>
    <tr>
        <td><span id="recordCount">0</span></td>
        <th class="rightproperty">Record Count</td>
    </tr>
    <tr>
        <td colspan="2"><input type="checkbox" id="showGraphs" name="showGraphs" value="true" /> Show Graphs</td>
    </tr>
</table>
<div style="border: 2px solid grey; width: 400px;">
<h2>Choose your sensors</h2>
<div id="pollDevs">
</div>
</div>
<div>
    <button type="button" lang="JavaScript" onclick="startPoll();">Start</button>
    <button type="button" lang="JavaScript" onclick="stopPoll();">Stop</button>
    <button type="button" lang="JavaScript" onclick="resetPoll();">Reset</button>
</div>
</form>
<div id="charts">
</div>
<table id="dataTable" style="clear: both;">
    <thead id="dataHead">
    </thead>
    <tbody id="dataBody">
    </tbody>
</table>
<script lang="JavaScript">
    var k = 0;
    var dataIndex = 0;
    var packetCount = 0;
    var recordCount = 0;
    var pollID = '';
    var sensors = 0;
    var units = [];
    var labels = [];
    var graphMin = [];
    var graphMax = [];

    /**
     * Starts the polling
     *
     * @return null
     */
    function startPoll()
    {
        var devs = [];
        //$.get("<?php print AJAX_GETDEVICE; ?>&id="+pollID.toString(16), setupPoll, "json");
        $('div#pollDevs input.pollDev').each(function() {
            var key = parseInt($(this).attr('value'));
            if ($(this).prop("checked")) {
                devs[parseInt(key)] = parseInt(key);
            }
        });
        setupPoll(devs);
    }
    /**
     * Stops the polling
     *
     * @return null
     */
    function stopPoll()
    {
        pollID = '';
    }
    /**
     * Resets everything
     *
     * @return null
     */
    function resetPoll()
    {
        $('#dataHead').html('');
        $('#dataBody').html('');
        $('#charts').html('');
        packetCount = 0;
        recordCount = 0;
        $('#packetCount').text(0);
        $('#recordCount').text(0);
        plot = [];
        showPollDevs();
    }
    /**
     * Resets everything
     *
     * @return null
     */
    function showPollDevs()
    {
        for (dev in devices) {
            if ($('#pollDevs #pollDev'+devices[dev].id).length == 0) {
                $('#pollDevs').append('<div id="pollDev'+devices[dev].id+'" class="device"></div>');
                var devDiv = '<div class="bold"><input onChange="showhideSensors(this);" id="pollDev'+devices[dev].id+'" type="checkbox" name="dev'+devices[dev].id+'" value="'+devices[dev].id+'" class="pollDev"/><span id="pollDev'+devices[dev].id+'"></span></div>';
                devDiv += '<div id="pollDev'+devices[dev].id+'Sensors" style="display: none;">';
                devDiv += '</div>';
                $('#pollDevs #pollDev'+devices[dev].id).html(devDiv);
            }
            $('#pollDevs span#pollDev'+devices[dev].id).html(devices[dev].DeviceID+':  '+devices[dev].DeviceName);

            for (sensor in devices[dev]['sensors']) {
                if ($('#pollDevs span#pollDev'+devices[dev].id+'Sensor'+sensor).length == 0) {
                    $('#pollDevs #pollDev'+devices[dev].id+'Sensors').append('<div id="pollDev'+devices[dev].id+'Sensor'+sensor+'" class="indent"><input id="pollDev'+devices[dev].id+'Sensor" type="checkbox" name="dev'+devices[dev].id+'Sensor'+sensor+'" value="'+sensor+'" class="pollDevSensor"/><span id="pollDev'+devices[dev].id+'Sensor'+sensor+'"></span></div>');
                }
                $('#pollDevs span#pollDev'+devices[dev].id+'Sensor'+sensor).html(
                    'Sensor'+sensor+':  '+devices[dev]['sensors'][sensor].location
                    +' ('+devices[dev]['sensors'][sensor].units+')'
                );
            }

        }
    }
    /**
     * Adds a row to the database
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function showhideSensors(me)
    {
        input = '#'+me.id;
        if (me.checked) {
            $(input+'Sensors').show();
        } else {
            $(input+'Sensors').hide();
        }
    }
    /**
     * Adds a row to the database
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function setupPoll(devs)
    {
        var sep = '';
        for (id in devs) {
            pollID += sep + devs[id].toString(16);
            sep = ',';
        }
        setHeader(devs);
        poll();
    }
    /**
     * Adds a row to the database
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function setHeader(devs)
    {
        var header = '<tr>';
        var defaultHeader;
        header += '<th>Date</th>';
        header += '<th>DataIndex</th>';
        for (id in devs) {
            header += setHeaderSensors(devices[devs[id]]);
        }
        header += '</tr>';

        $('#dataTable #dataHead').html(header)
    }
    /**
     * Adds a row to the database
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function setHeaderSensors(data)
    {
        var devHeader = '';
        dev = data['id'];
        var key;
        $('div#pollDevs input#pollDev'+dev+'Sensor').each(function() {
            if (!$(this).prop("checked")) {
                return;
            }
            i = $(this).prop('value');
            if (data['sensors'][i] != undefined) {
                key = dev + '.' + i;
                labels[key] = 'Sensor ' + i;
                units[key] = 'Unknown';
                graphMin[key] = 0;
                graphMax[key] = 150;
                devHeader += '<th id="'+ key +'">';
                defaultHeader = labels[key] + '<br />';
                if ((data['sensors'][i] != undefined)) {
                    if (data['sensors'][i]['location'].length > 0) {
                        devHeader += data['sensors'][i]['location']+'<br />';
                        labels[key] = data['sensors'][i]['location'];
                    } else {
                        devHeader += defaultHeader;
                    }
                    if (data['sensors'][i]['units'] != undefined) {
                        devHeader += data['sensors'][i]['units'];
                        units[key] = data['sensors'][i]['units'];
                    }
                    if (data['sensors'][i]['max'] != undefined) {
                        graphMax[key] = parseInt(data['sensors'][i]['max']);
                    }
                    if (data['sensors'][i]['min'] != undefined) {
                        graphMin[key] = parseInt(data['sensors'][i]['min']);
                    }

                } else {
                    devHeader += defaultHeader;
                }
                devHeader += '</th>';
                if ($('#showGraphs').prop('checked') && ($('#chart'+key).length == 0)) {
                    $('#charts').append('<div id="chart'+key+'" class="plot" style="width:250px;height:170px; float: left;"></div>');
                }
            }
        });
        return devHeader;
    }
    /**
     * Polls for data once
     *
     * @return null
     */
    function poll()
    {
        if (pollID.length > 0) {
            $.get("<?php print AJAX_POLL; ?>&id="+pollID, addRow, "json");
        }
    }
    /**
     * Adds a row to the database
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function addRow(data)
    {
        if (data.DataIndex != dataIndex) {
            k = 1 - k;
            var plot = [];
            var row = '<tr class="row'+k+'"><td class="date">' + data.Date + '</td>'
                    + '<td class="dataindex">' + data.DataIndex + '</td>';
            $('#dataTable #dataHead th').each(function() {
                i = $(this).prop('id');
                var key = i.replace('.', '\\.');
                if ((data.Data != undefined) && (data.Data[i] != undefined)) {
                    row += '<td class="data">' + data.Data[i] + '</td>';
                    if (($('#chart' + key).length > 0)
                        && (labels[i] != undefined)
                        && (units[i] != undefined)
                    ) {
                        plot[i] = $.jqplot('chart'+key,[[data.Data[i]]],{
                            title: labels[i],
                            seriesDefaults: {
                                renderer: $.jqplot.MeterGaugeRenderer,
                                rendererOptions: {
                                    min: graphMin[i],
                                    max: graphMax[i],
                                    label: units[i],
                                    background: '#EEEEEE',
                                    ringColor: '#000000',
                                    needleColor: '#FF0000',
                                    textColor: '#000000',
                                }
                            }
                        });
                    }
                }

            });
            row = row + '</tr>';

            $('#dataTable #dataBody').prepend(row);
            recordCount++;
            $('#recordCount').text(recordCount);


        }
        dataIndex = data.DataIndex;
        packetCount++;
        $('#packetCount').text(packetCount);
        poll();
    }
    /**
     * This function runs when the document is ready
     */
    $(document).ready(function(){
        $('#pollDevs').text("HELLO");
        /*
        */
    });
</script>

