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
<table>
    <tr>
        <th class="leftproperty">Device:</th>
        <td>
            <input id="devid" type="text" name="id" value="0" />
        </td>
    </tr>
    <tr>
        <th class="leftproperty">Packet Count:</td>
        <td><span id="packetCount">0</span></td>
    </tr>
    <tr>
        <th class="leftproperty">Record Count:</td>
        <td><span id="recordCount">0</span></td>
    </tr>
    <tr>
        <td colspan="2">
            <button type="button" lang="JavaScript" onclick="startPoll();">Start</button>
            <button type="button" lang="JavaScript" onclick="stopPoll();">Stop</button>
            <button type="button" lang="JavaScript" onclick="resetPoll();">Reset</button>
        </td>
    </tr>
</table>
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
    var pollID = 0;
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
        pollID = parseInt($('input#devid').val(), 16);
        $.get("<?php print AJAX_GETDEVICE; ?>&id="+pollID.toString(16), setupPoll, "json");
    }
    /**
     * Stops the polling
     *
     * @return null
     */
    function stopPoll()
    {
        pollID = 0;
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
    }
    /**
     * Adds a row to the database
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function setupPoll(data)
    {
        setHeader(data);
        poll();
    }
    /**
     * Adds a row to the database
     *
     * @param data The data to use to set up the device
     *
     * @return null
     */
    function setHeader(data)
    {
        var header = '<tr>';
        var defaultHeader;
        sensors = data['totalSensors'];
        header += '<th>Date</th>';
        header += '<th>DataIndex</th>';
        for (i = 0; i < sensors; i++) {
            if ((data['sensors'][i] != undefined)
                && (data['sensors'][i]['dataType'] != 'ignore')
            ) {
                labels[i] = 'Sensor ' + i;
                units[i] = 'Unknown';
                graphMin[i] = 0;
                graphMax[i] = 150;
                header += '<th id="sensor' + i +'">';
                defaultHeader = labels[i] + '<br />';
                if ((data['sensors'][i] != undefined)) {
                    if (data['sensors'][i]['location'].length > 0) {
                        header += data['sensors'][i]['location']+'<br />';
                        labels[i] = data['sensors'][i]['location'];
                    } else {
                        header += defaultHeader;
                    }
                    if (data['sensors'][i]['units'] != undefined) {
                        header += data['sensors'][i]['units'];
                        units[i] = data['sensors'][i]['units'];
                    }
                    if (data['sensors'][i]['max'] != undefined) {
                        graphMax[i] = parseInt(data['sensors'][i]['max']);
                    }
                    if (data['sensors'][i]['min'] != undefined) {
                        graphMin[i] = parseInt(data['sensors'][i]['min']);
                    }

                } else {
                    header += defaultHeader;
                }
                header += '</th>';
                if ($('#chart'+i).length == 0) {
                    $('#charts').append('<div id="chart'+i+'" style="width:250px;height:170px; float: left;"></div>');
                }
            }
        }
        header += '</tr>';

        $('#dataTable #dataHead').html(header)
    }
    /**
     * Polls for data once
     *
     * @return null
     */
    function poll()
    {
        if (pollID > 0) {
            $.get("<?php print AJAX_POLL; ?>&id="+pollID.toString(16), addRow, "json");
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
            for (i = 0; i < sensors; i++) {
                if ($('#dataHead th#sensor' + i).length > 0) {
                    row = row + '<td class="data">' + data.Data[i] + '</td>';
                    if (($('#chart' + i).length > 0)
                        && (data.Data[i] != undefined)
                        && (labels[i] != undefined)
                        && (units[i] != undefined)
                    ) {
                        $('#chart'+i).html("");
                        plot[i] = $.jqplot('chart'+i,[[data.Data[i]]],{
                            title: labels[i],
                            seriesDefaults: {
                                renderer: $.jqplot.MeterGaugeRenderer,
                                rendererOptions: {
                                    min: graphMin[i],
                                    max: graphMax[i],
                                    label: units[i],
                                }
                            }
                        });
                    }

                }
            }
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
    $(document).ready(function(){
    });
</script>

