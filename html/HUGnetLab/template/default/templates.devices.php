<!--  These are our tempaltes -->
        <script type="text/template" id="DevicePropertiesTitleTemplate">
            Device <%= DeviceID %>:<%= DeviceName %>
        </script>
        <script type="text/template" id="DevicePropertiesTemplate">
                <form id="deviceForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="SaveDevice save">Save</button>
                </div>
                <table style="width:100%;">
                    <tr class="odd"><th class="right">Serial #</th><td><%= id %></td></tr>
                    <tr class="even"><th class="right">Device ID</th><td><%= DeviceID %></td></tr>
                    <tr class="odd">
                        <th class="right">Name</th>
                        <td><input type="text" class="DeviceName" value="<%= DeviceName %>"/></td>
                    </tr>
                    <tr class="even">
                        <th class="right">Location</th>
                        <td><input type="text" class="DeviceLocation" value="<%= DeviceLocation %>" /></td>
                    </tr>
                    <tr class="odd">
                        <th class="right">Job</th>
                        <td><input type="text" class="DeviceJob" value="<%= DeviceJob %>" /></td>
                    </tr>
                    <tr class="even"><th class="right">Hardware</th><td><%= HWPartNum %></td></tr>
                    <tr class="odd"><th class="right">Firmware</th><td><%= FWPartNum %></td></tr>
                    <tr class="even"><th class="right">Version</th><td><%= FWVersion %></td></tr>
                    <tr class="odd"><th class="right">Raw Setup</th><td><%= RawSetup %></td></tr>
                    <tr><th colspan="2">Properties</th></tr>
                    <tr class="odd">
                        <th class="right">Last Contact</th>
                        <td>
                            <%= formatDate(params.LastContact) %>
                        </td>
                    </tr>
                    <tr class="even">
                        <th class="right">Last Poll</th>
                        <td>
                            <%= formatDate(params.LastPoll) %>
                        </td>
                    </tr>
                    <tr class="odd">
                        <th class="right">Last Config</th>
                        <td>
                            <%= formatDate(params.LastConfig) %>
                        </td>
                    </tr>
                    <tr class="even">
                        <th class="right">Last Modified</th>
                        <td>
                            <%= formatDate(params.LastModified) %>
                        </td>
                    </tr>
                    <tr><th colspan="2">Sensors</th></tr>
                    <tr><td colspan="2"><%= sensors %></th></tr>
                </table>
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
                        <th class="{sorter: 'text'}">Type</th>
                    </tr>
                    </thead>
                    <tbody id="DeviceList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="DeviceEntryTemplate">
                    <td>
                        <button class="properties">Edit</button>
                        <button class="refresh">Refresh</button>
                    </td>
                    <td><%= DeviceName %></td>
                    <td class="center"><%= DeviceID %></td>
                    <td class="center"><%= id %></td>
                    <td class="center"><%= HWPartNum %></td>
                    <td class="center"><%= FWPartNum %> <%= FWVersion %></td>
                    <td class="center"><%= type %></td>
        </script>
<!--  These are our tempaltes -->
        <script type="text/template" id="DeviceSensorPropertiesTitleTemplate">
            Device <%= sensor %>:<%= location %>
        </script>
        <script type="text/template" id="DeviceSensorPropertiesTemplate">
                <form id="sensorForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="save">Save</button>
                </div>
                <table style="width: 100%;">
                    <tbody>
                    <tr><th>Sensor #</th><td><%= sensor %></td></tr>
                    <tr><th>Sensor ID</th><td><% print(parseInt(id).toString(16).toUpperCase()); %></td></tr>
                    <tr>
                        <th>Name</th>
                        <td>
                            <input type="text" name="location" value="<%= location %>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>
                            <select name="type" class="type">
                                <% for (key in otherTypes) { %>
                                    <option value="<%- otherTypes[key] %>" <% (otherTypes[key] == type) && print('selected="selected"'); %>>
                                        <%= otherTypes[key] %>
                                    </option>
                                <% } %>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Data Type</th>
                        <td>
                            <select name="dataType">
                                <% for (key in dataTypes) { %>
                                    <option value="<%- dataTypes[key] %>" <% (dataTypes[key] == dataType) && print('selected="selected"'); %>>
                                        <%= dataTypes[key] %>
                                    </option>
                                <% } %>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Units</th>
                        <td>
                            <select name="units" onChange="submit();">
                                <% for (key in validUnits) { %>
                                    <option value="<%- validUnits[key] %>" <% (validUnits[key] == units) && print('selected="selected"'); %>>
                                        <%= validUnits[key] %>
                                    </option>
                                <% } %>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Graph Min</th>
                        <td>
                            <input type="text" name="min" value="<%= min %>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Graph Max</th>
                        <td>
                            <input type="text" name="max" value="<%= max %>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Decimals</th>
                        <td>
                            <select name="decimals" onChange="submit();">
                                <%= selectInt(0, maxDecimals, 1, decimals) %>
                            </select>
                        </td>
                    </tr>
                    <!-- Sensor Extra Parameters -->
                    <%
                    for (key in extraDefault) {
                        var etext;
                        var efield = 'extra['+key+']';
                        var evalue;
                        if ((extra == undefined)
                            || (extra[key] == undefined)
                        ) {
                            evalue = extraDefault[key];
                        } else {
                            evalue = extra[key];
                        }
                        var type = extraValues[key];
                        etext  = '<tr>';
                        etext += '<th>'+extraText[key]+'</th><td>';
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
                        etext += '</td></tr>';
                        print(etext);
                    }
                    %>
                    </tr>
                </table>
                </form>
        </script>
        <script type="text/template" id="DeviceSensorListTemplate">
                <table id="sensorTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th style="width: 10%;">Action</th>
                        <th style="width: 5%;">#</th>
                        <th>Name</th>
                        <th style="width: 5%;">Type</th>
                        <th style="width: 10%;">Data Type</th>
                        <th style="width: 10%;">Decimals</th>
                    </tr>
                    </thead>
                    <tbody id="DeviceList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="DeviceSensorEntryTemplate">
                    <td>
                        <button class="properties">Edit</button>
                    </td>
                    <td class="center"><%= (parseInt(sensor) + 1) %></td>
                    <td><% (location.length > 0) ? print(location) : print("Sensor " + (parseInt(sensor) + 1)); %></td>
                    <td class="center"><%= type %></td>
                    <td class="center"><%= dataType %></td>
                    <td class="center"><%= decimals %></td>
        </script>
