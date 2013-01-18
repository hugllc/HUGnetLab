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
                    <tr class="even">
                        <th class="right">Data Interval</th>
                        <td><input type="text" class="PollInterval" value="<%= PollInterval %>" /></td>
                    </tr>
                    <tr class="odd"><th class="right">Hardware</th><td><%= HWPartNum %></td></tr>
                    <tr class="even"><th class="right">Firmware</th><td><%= FWPartNum %></td></tr>
                    <tr class="odd"><th class="right">Version</th><td><%= FWVersion %></td></tr>
                    <tr class="even"><th class="right">Raw Setup</th><td><%= RawSetup %></td></tr>
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
                    <tr class="odd">
                        <th class="right">Last Push to Master</th>
                        <td>
                            <%= formatDate(params.LastMasterPush) %>
                        </td>
                    </tr>
                    <tr class="odd">
                        <th class="right">Last History to Master</th>
                        <td>
                            <%= formatDate(params.LastMasterHistoryPush) %>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button class="inputList">Edit Inputs</button>
                            <button class="outputList">Edit Outputs</button>
                            <button class="processList">Edit Processes</button>
                        </td>
                    </tr>
                    <tr><th colspan="2">Data Channels</th></tr>
                    <tr><td colspan="2"><%= dataChannels %></th></tr>
                </table>
                </form>
        </script>
        <script type="text/template" id="DeviceListTemplate">
                <form id="deviceListForm" method="POST" action="javascript:void(0);">
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
                </form>
        </script>
        <script type="text/template" id="DeviceEntryTemplate">
                    <td>
                        <select class="action">
                            <option value="">Action</option>
                            <option value="refresh">Refresh</option>
                            <option value="properties">Edit</option>
                            <% if ((typeof update !== 'undefined') || (type === "bootloader")) { %>
                                <option value="loadfirmware">Update Firmware</option>
                            <% } %>
                            <option value="loadconfig">Update Config</option>
                        </select>
                    </td>
                    <td><%= DeviceName %></td>
                    <td class="center"><%= DeviceID %></td>
                    <td class="center"><%= id %></td>
                    <td class="center"><%= HWPartNum %></td>
                    <td class="center"><%= FWPartNum %> <%= FWVersion %></td>
                    <td class="center"><%= type %></td>
        </script>

        <script type="text/template" id="DeviceDataChannelListTemplate">
                <table id="channelTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Label</th>
                        <th style="width: 5%;">Data Type</th>
                        <th style="width: 5%;">Units</th>
                        <th style="width: 10%;">Decimals</th>
                    </tr>
                    </thead>
                    <tbody id="channelList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="DeviceDataChannelEntryTemplate">
                    <td class="center"><%= channel %></td>
                    <td><input type="text" name="label" value="<%= label %>"/><% (epChannel == null) && print("(Virtual)"); %>
                    <td class="center">
                        <select name="dataType">
                            <option value="raw" <% (dataType == "raw") && print('selected="selected"'); %>>
                                Raw
                            </option>
                            <option value="ignore" <% (dataType == "ignore") && print('selected="selected"'); %>>
                                Ignore
                            </option>
                        </select>
                    </td>
                    <td class="center">
                        <select name="units">
                            <% for (key in validUnits) { %>
                                <option value="<%- validUnits[key] %>" <% (validUnits[key] == units) && print('selected="selected"'); %>>
                                    <%= validUnits[key] %>
                                </option>
                            <% } %>
                        </select>
                    </td>
                    <td class="center">
                        <select name="decimals">
                            <%= selectInt(0, maxDecimals, 1, decimals) %>
                        </select>
                    </td>
        </script>


        <!--  These are our tempaltes -->
        <script type="text/template" id="DeviceInputPropertiesTitleTemplate">
            Device <%= input %>:<%= location %>
        </script>
        <script type="text/template" id="DeviceInputPropertiesTemplate">
                <form id="inputForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="save">Save</button>
                </div>
                <table style="width: 100%;">
                    <tbody>
                    <tr><th>Input #</th><td><%= input %></td></tr>
                    <tr>
                        <th>Input ID</th>
                        <td>
                            <select name="id" class="id">
                                <% for (key in validIds) { %>
                                    <option value="<%- key %>" <% (key == id) && print('selected="selected"'); %>>
                                        <% print(parseInt(key, 10).toString(16).toUpperCase()) %>:<%= validIds[key] %>
                                    </option>
                                <% } %>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Label</th>
                        <td>
                            <input type="text" name="location" value="<%= location %>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Driver</th>
                        <td>
                            <%= longName %>
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
                    <!-- Input Extra Parameters -->
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
        <script type="text/template" id="DeviceInputListTemplate">
                <table id="inputTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th style="width: 10%;">Action</th>
                        <th style="width: 5%;">#</th>
                        <th>Name</th>
                        <th style="width: 5%;">Type</th>
                    </tr>
                    </thead>
                    <tbody id="DeviceList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="DeviceInputEntryTemplate">
                    <td>
                        <button class="properties">Edit</button>
                    </td>
                    <td class="center"><%= input %></td>
                    <td><% (location.length > 0) ? print(location) : print("Input " + parseInt(input)); %></td>
                    <td class="center"><%= type %></td>
        </script>
        <!--  These are our tempaltes -->
        <script type="text/template" id="DeviceOutputPropertiesTitleTemplate">
            Device <%= input %>:<%= location %>
        </script>
        <script type="text/template" id="DeviceOutputPropertiesTemplate">
                <form id="inputForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="save">Save</button>
                </div>
                <table style="width: 100%;">
                    <tbody>
                    <tr><th>Output #</th><td><%= output %></td></tr>
                    <tr>
                        <th>Input ID</th>
                        <td>
                            <select name="id" class="id">
                                <% for (key in validIds) { %>
                                    <option value="<%- key %>" <% (key == id) && print('selected="selected"'); %>>
                                        <% print(parseInt(key, 10).toString(16).toUpperCase()) %>:<%= validIds[key] %>
                                    </option>
                                <% } %>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Label</th>
                        <td>
                            <input type="text" name="location" value="<%= location %>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Driver</th>
                        <td>
                            <%= longName %>
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
                    <!-- Input Extra Parameters -->
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
        <script type="text/template" id="DeviceOutputListTemplate">
                <table id="inputTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th style="width: 10%;">Action</th>
                        <th style="width: 5%;">#</th>
                        <th>Name</th>
                        <th style="width: 5%;">Type</th>
                    </tr>
                    </thead>
                    <tbody id="DeviceList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="DeviceOutputEntryTemplate">
                    <td>
                        <button class="properties">Edit</button>
                    </td>
                    <td class="center"><%= output %></td>
                    <td><% (location.length > 0) ? print(location) : print("Output " + parseInt(output)); %></td>
                    <td class="center"><%= type %></td>
        </script>


                <!--  These are our tempaltes -->
        <script type="text/template" id="DeviceProcessPropertiesTitleTemplate">
            Device <%= input %>:<%= location %>
        </script>
        <script type="text/template" id="DeviceProcessPropertiesTemplate">
                <form id="inputForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="save">Save</button>
                </div>
                <table style="width: 100%;">
                    <tbody>
                    <tr><th>Process #</th><td><%= process %></td></tr>
                    <tr>
                        <th>Input ID</th>
                        <td>
                            <select name="id" class="id">
                                <% for (key in validIds) { %>
                                    <option value="<%- key %>" <% (key == id) && print('selected="selected"'); %>>
                                        <% print(parseInt(key, 10).toString(16).toUpperCase()) %>:<%= validIds[key] %>
                                    </option>
                                <% } %>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Label</th>
                        <td>
                            <input type="text" name="location" value="<%= location %>"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Driver</th>
                        <td>
                            <%= longName %>
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
                    <!-- Input Extra Parameters -->
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
        <script type="text/template" id="DeviceProcessListTemplate">
                <table id="inputTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th style="width: 10%;">Action</th>
                        <th style="width: 5%;">#</th>
                        <th>Name</th>
                        <th style="width: 5%;">Type</th>
                    </tr>
                    </thead>
                    <tbody id="DeviceList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="DeviceProcessEntryTemplate">
                    <td>
                        <button class="properties">Edit</button>
                    </td>
                    <td class="center"><%= process %></td>
                    <td><% (location.length > 0) ? print(location) : print("Process " + parseInt(process)); %></td>
                    <td class="center"><%= type %></td>
        </script>


