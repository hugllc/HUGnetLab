<!--  These are our tempaltes -->
        <script type="text/template" id="DeviceEntryTemplate">
                    <td>
                        <button class="properties">View</button>
                        <button class="refresh">Refresh</button>
                    </td>
                    <td><%= DeviceName %></td>
                    <td><%= DeviceID %></td>
                    <td><%= id %></td>
                    <td><%= HWPartNum %></td>
                    <td><%= FWPartNum %> <%= FWVersion %></td>
        </script>
        <script type="text/template" id="DevicePropertiesTemplate">
                <form id="deviceForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="SaveDevice save">Save</button>
                    <button class="cancel">Back to List</button>
                </div>
                <h2>Edit Device <%= DeviceID %>: <%= DeviceName %></h2>
                <table style="width:100%;">
                    <tr class="row0"><th>Serial #</th><td><%= id %></td></tr>
                    <tr class="row1"><th>Device ID</th><td><%= DeviceID %></td></tr>
                    <tr class="row0">
                        <th>Name</th>
                        <td><input type="text" class="DeviceName" value="<%= DeviceName %>"/></td>
                    </tr>
                    <tr class="row1">
                        <th>Location</th>
                        <td><input type="text" class="DeviceLocation" value="<%= DeviceLocation %>" /></td>
                    </tr>
                    <tr class="row0">
                        <th>Job</th>
                        <td><input type="text" class="DeviceJob" value="<%= DeviceJob %>" /></td>
                    </tr>
                    <tr class="row1"><th>Hardware</th><td><%= HWPartNum %></td></tr>
                    <tr class="row0"><th>Firmware</th><td><%= FWPartNum %></td></tr>
                    <tr class="row1"><th>Version</th><td><%= FWVersion %></td></tr>
                    <tr class="row0"><th>Raw Setup</th><td><%= RawSetup %></td></tr>
                    <tr><th colspan="2">Properties</th></tr>
                    <tr class="row0"><th>LastContact</th><td><%= params.LastContact %></td></tr>
                </table>
                </form>
                <form id="sensorForm" method="POST" action="javascript:void(0);">
                <input type="submit" value="Save Sensors" class="save"/>
                <table>
                    <thead>
                    <tr>
                        <th colspan="8">Sensors</th>
                    </tr>
                    <tr id="deviceSensorHead">
                        <th>#</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Data<br />Type</th>
                        <th>Parameters</th>
                        <th>Units</th>
                        <th>Graph Min/Max</th>
                        <th>Decimal</br>Places</th>
                    </tr>
                    </thead>
                    <tbody>
                    <% for (i = 0; i < totalSensors; i++) { %>
                        <% sensor = sensors[i]; %>
                        <tr class="row<% print(i % 2); %>">
                            <td class="center">
                                <!-- Sensor Number -->
                                <%= sensor.sensor %>
                            </td>
                            <td>
                                <!-- Sensor Name -->
                                <input type="text" name="sensor[<%= sensor.sensor %>][location]" value="<%= sensor.location %>" />
                            </td>
                            <td>
                                <!-- Sensor Type -->
                                <select name="sensor[<%= sensor.sensor %>][type]">
                                    <% for (key in sensor.otherTypes) { %>
                                        <option value="<%- sensor.otherTypes[key] %>" <% if (sensor.otherTypes[key] == sensor.type) print('selected="selected"'); %>>
                                            <%= sensor.otherTypes[key] %>
                                        </option>
                                    <% } %>
                                </select>
                            </td>
                            <td class="center">
                                <!-- Sensor dataType -->
                                <select name="sensor[<%= sensor.sensor %>][dataType]">
                                    <% for (key in sensor.dataTypes) { %>
                                        <option value="<%- sensor.dataTypes[key] %>" <% if (sensor.dataTypes[key] == sensor.dataType) print('selected="selected"'); %>>
                                            <%= sensor.dataTypes[key] %>
                                        </option>
                                    <% } %>
                                </select>
                            </td>
                            <td class="right">
                                <!-- Sensor Extra Parameters -->
                                <%
                                for (key in sensor.extraDefault) {
                                    var etext;
                                    var efield = 'sensors['+sensor.sensor+'][extra]['+key+']';
                                    var evalue;
                                    if ((sensor.extra == undefined)
                                        || (sensor.extra[key] == undefined)
                                    ) {
                                        evalue = sensor.extraDefault[key];
                                    } else {
                                        evalue = sensor.extra[key];
                                    }
                                    var type = sensor.extraValues[key];
                                    etext  = '<div class="nowrap">';
                                    etext += '<span class="bold">'+sensor.extraText[key]+':</span>';
                                    if ((parseFloat(type) == parseInt(type)) && !isNaN(type)) {
                                        etext += '<input type="text" name="'+efield+'" '
                                            + 'value="' + evalue + '" size="'+(type+2)+'" maxlength="'+type+'"/>';
                                    } else if (typeof type === 'object') {
                                        etext += '<select name="'+efield+'" >';
                                        for (q in type)
                                        {
                                            etext += '<option value="'+q.replace('&', '&amp;')+'"';
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
                                    print(etext);
                                }
                                %>
                            </td>
                            <td class="center">
                                <select name="sensor[<%= sensor.sensor %>][units]" onChange="submit();">
                                    <% for (key in sensor.validUnits) { %>
                                        <option value="<%- sensor.validUnits[key] %>" <% if (sensor.validUnits[key] == sensor.units) print('selected="selected"'); %>>
                                            <%= sensor.validUnits[key] %>
                                        </option>
                                    <% } %>
                                </select>
                            </td>
                            <td class="right">
                                <!-- Sensor Min / Max Parameters -->
                                <span class="bold">Min:</span><input type="text" name="sensor[<%= sensor.sensor %>][max]" value="<%= sensor.min %>" size="6" /> <br />
                                <span class="bold">Max:</span><input type="text" name="sensor[<%= sensor.sensor %>][max]" value="<%= sensor.max %>" size="6" />
                            </td>
                            <td class="center">
                                <!-- Sensor Decimal Places -->
                                <select name="sensor[<%= sensor.sensor %>][units]" onChange="submit();">
                                    <% for (j = 0; j < sensor.maxDecimals; j++) { %>
                                        <option value="<%- j %>" <% if (j == sensor.decimals) print('selected="selected"'); %>>
                                            <%= j %>
                                        </option>
                                    <% } %>
                                </select>
                            </td>
                        </tr>
                    <% } %>
                    </tbody>
                </table>
                <input type="submit" value="Save Sensors" class="save"/>
                </form>
        </script>
        <script type="text/template" id="DeviceListTemplate">
                <table id="devTable" class="tablesorter">
                    <thead>
                    <tr>
                        <th class="{sorter: false}">Actions</th>
                        <th class="{sorter: 'text'}">Name</th>
                        <th class="{sorter: 'text'}">ID</th>
                        <th class="{sorter: 'numeric'}">Serial #</th>
                        <th class="{sorter: 'text'}">Hardware</th>
                        <th class="{sorter: 'text'}">Firmware</th>
                    </tr>
                    </thead>
                    <tbody id="DeviceList">
                    </tbody>
                </table>
        </script>
