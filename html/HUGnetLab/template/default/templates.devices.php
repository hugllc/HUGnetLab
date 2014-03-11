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
                    <tr class="odd">
                        <th class="right">Info Link URL</th>
                        <td><input type="text" class="params_InfoLink" value="<% (params.InfoLink) ? print(params.InfoLink) : ""; %>" /></td>
                    </tr>
                    <tr class="even">
                        <th class="right">Image URL</th>
                        <td><input type="text" class="params_ImageURL" value="<% (params.ImageURL) ? print(params.ImageURL) : ""; %>" /></td>
                    </tr>
                    <tr class="odd">
                        <th class="right">Log URL</th>
                        <td><input type="text" class="params_LogURL" value="<% (params.LogURL) ? print(params.LogURL) : ""; %>" /></td>
                    </tr>
                    <tr class="even">
                        <th class="right">Active</th>
                        <td>
                            <select name="Active" class="Active">
                               <option value="1" <% (Active == 1) && print('selected="selected"'); %>>Yes</option>
                               <option value="0" <% (Active == 0) && print('selected="selected"'); %>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="odd">
                        <th class="right">Role</th>
                        <td>
                            <select name="Role" class="Role">
                                <% for (key in Roles) { %>
                                    <option value="<%- key %>" <% (key == Role) && print('selected="selected"'); %>>
                                        <%= Roles[key] %>
                                    </option>
                                <% } %>
                            </select>
                        </td>
                    </tr>
                    <tr class="even">
                        <th class="right">Push History to Master</th>
                        <td>
                            <select class="params_PushHistory">
                               <option value="1" <% (params.PushHistory == 1) && print('selected="selected"'); %>>Yes</option>
                               <option value="0" <% (params.PushHistory == 0) && print('selected="selected"'); %>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="odd">
                        <th class="right">Publish</th>
                        <td>
                            <select name="Publish" class="Publish">
                               <option value="1" <% (Publish == 1) && print('selected="selected"'); %>>Yes</option>
                               <option value="0" <% (Publish == 0) && print('selected="selected"'); %>>No</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="even">
                        <th class="right">Daughter Board</th>
                        <td>
                            <select class="params_DaughterBoard">
                                <% for (key in DaughterBoards) { %>
                                    <option value="<%- key %>" <% (key == params.DaughterBoard) && print('selected="selected"'); %>>
                                        <%= DaughterBoards[key] %>
                                    </option>
                                <% } %>
                            </select>
                        </td>
                    </tr>
                    <tr class="even"><th class="right">Driver</th><td><%= Driver %></td></tr>
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
                    <tr>
                        <th colspan="2">
                            Channels
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table style="width:100%;">
                                <tr>
                                    <th>Data Channels</th>
                                    <th>Control Channels</th>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">
                                        <%= dataChannels %>
                                    </td>
                                    <td style="vertical-align: top;">
                                        <%= controlChannels %>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                </form>
        </script>
        <script type="text/template" id="DeviceListTemplate">
                <div>
                    <button class="loadall" style="float:left;">Load All Devices</button>
                    <button class="newtest" style="float:left;">New Test</button>
                    <button class="newfastvirtual" style="float:left;">New Fast Virtual</button>
                    <button class="newslowvirtual" style="float:left;">New Slow Virtual</button>
                    <form style="float:left; margin-left: 3em;" id="importDevice" enctype="multipart/form-data" action="javascript:void(0);" method="POST">
                        <!-- MAX_FILE_SIZE must precede the file input field -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                        <!-- Name of input element determines name in $_FILES array -->
                        <input type="button" class="importDevice" value="Import" />
                        </span><input name="import" type="file" />
                    </form>
                </div>
                <div style="clear:both;">
                <form id="deviceListForm" method="POST" action="javascript:void(0);">
                <table id="devTable" class="tablesorter {sortlist: [[2,0]]}">
                    <thead>
                    <tr>
                        <th class="sorter-false">Actions</th>
                        <th class="sorter-text">Name</th>
                        <th class="sorter-hex">ID</th>
                        <th class="sorter-numeric">Serial #</th>
                        <th class="sorter-text">Active</th>
                        <th class="sorter-text">Publish</th>
                        <th class="sorter-text">Push History</th>
                        <th class="sorter-text">Hardware</th>
                        <th class="sorter-text">Firmware</th>
                        <th class="sorter-text">Type</th>
                    </tr>
                    </thead>
                    <tbody id="DeviceList">
                    </tbody>
                </table>
                </form>
                </div>
        </script>
        <script type="text/template" id="DeviceEntryTemplate">
                    <td>
                        <select class="action">
                            <option value="">Action</option>
                            <option value="properties">Edit</option>
                            <option value="configview">Wiring Diagram</option>
                            <option value="export">Export</option>
                            <option value="refresh">Read the Config</option>
                            <option value="loadconfig">Write the Config</option>
                            <% if ((typeof update !== 'undefined') || (type === "bootloader")) { %>
                                <option value="loadfirmware">Update Firmware</option>
                            <% } %>
                        </select>
                    </td>
                    <td><%= DeviceName %></td>
                    <td class="center"><%= DeviceID %></td>
                    <td class="center"><%= id %></td>
                    <td class="center"><% (Active == 1) ? print('Yes') : print('No'); %></td>
                    <td class="center"><% (Publish == 1) ? print('Yes') : print('No'); %></td>
                    <td class="center"><% (params.PushHistory == 1) ? print('Yes') : print('No'); %></td>
                    <td class="center"><%= HWPartNum %></td>
                    <td class="center"><%= FWPartNum %> <%= FWVersion %></td>
                    <td class="center"><%= type %></td>
        </script>

        <script type="text/template" id="DeviceDataChannelListTemplate">
                <table id="dataChannelTable" style="width: 100%;">
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
                    <td><%= label %><% (epChannel == null) && print(" (Virtual)"); %></td>
                    <td class="center">
                        <select name="dataType">
                            <% for (key in validTypes) { %>
                                <option value="<%- validTypes[key] %>" <% (validTypes[key] == dataType) && print('selected="selected"'); %>>
                                    <%= validTypes[key] %>
                                </option>
                            <% } %>
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
        <script type="text/template" id="DeviceControlChannelListTemplate">
                <table id="controlChannelTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th>Label</th>
                    </tr>
                    </thead>
                    <tbody id="channelList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="DeviceControlChannelEntryTemplate">
                    <td class="center"><%= channel %></td>
                    <td><%= label %></td>
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
                    <tr><th class="right">Input #</th><td><%= input %></td></tr>
                    <tr>
                        <th class="right">Input ID</th>
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
                        <th class="right">Label</th>
                        <td>
                            <input type="text" name="location" value="<%= location %>"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="right">Driver</th>
                        <td>
                            <%= longName %>
                        </td>
                    </tr>
                    <tr>
                        <th class="right">Type</th>
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
                    <tr><th colspan="2">Extra Parameters</th></tr>
                    <% print(tDefault.ExtraTable(extra, extraDefault, extraDesc, extraValues, extraText, "extra")) %>
                    <tr><th colspan="2">Input Table Entry</th></tr>
                    <tr>
                        <th class="right">Last Table Copied</th>
                        <td><%= lastTable %></td>
                    </tr>
                    <tr>
                        <th class="right">Copy Table From</th>
                        <td><% print(tDefault.iopOtherTables(otherTables, "setTable", parseInt(tableEntry.fixed))) %></td>
                    </tr>
                    <% print(tDefault.iopTableTable(fullEntry, "tableEntry", parseInt(tableEntry.fixed))) %>
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
            Device <%= output %>:<%= location %>
        </script>
        <script type="text/template" id="DeviceOutputPropertiesTemplate">
                <form id="outputForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="save">Save</button>
                </div>
                <table style="width: 100%;">
                    <tbody>
                    <tr><th class="right">Output #</th><td><%= output %></td></tr>
                    <tr>
                        <th class="right">Output ID</th>
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
                        <th class="right">Label</th>
                        <td>
                            <input type="text" name="location" value="<%= location %>"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="right">Driver</th>
                        <td>
                            <%= longName %>
                        </td>
                    </tr>
                    <tr>
                        <th class="right">Type</th>
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
                    <!-- Output Extra Parameters -->
                    <tr><th colspan="2">Extra Parameters</th></tr>
                    <% print(tDefault.ExtraTable(extra, extraDefault, extraDesc, extraValues, extraText, "extra")) %>
                    <tr><th colspan="2">Output Table Entry</th></tr>
                    <tr>
                        <th class="right">Copy Table From</th>
                        <td><% print(tDefault.iopOtherTables(otherTables, "setTable", parseInt(tableEntry.fixed))) %></td>
                    </tr>
                    <% print(tDefault.iopTableTable(fullEntry, "tableEntry", parseInt(tableEntry.fixed))) %>
                </table>
                </form>
        </script>
        <script type="text/template" id="DeviceOutputListTemplate">
                <table id="outputTable" style="width: 100%;">
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
            Device <%= process %>:<%= location %>
        </script>
        <script type="text/template" id="DeviceProcessPropertiesTemplate">
                <form id="processForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="save">Save</button>
                </div>
                <table style="width: 100%;">
                    <tbody>
                    <tr><th class="right">Process #</th><td><%= process %></td></tr>
                    <tr>
                        <th class="right">Process ID</th>
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
                        <th class="right">Label</th>
                        <td>
                            <input type="text" name="location" value="<%= location %>"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="right">Driver</th>
                        <td>
                            <%= longName %>
                        </td>
                    </tr>
                    <tr>
                        <th class="right">Type</th>
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
                    <!-- Process Extra Parameters -->
                    <tr><th colspan="2">Extra Parameters</th></tr>
                    <% print(tDefault.ExtraTable(extra, extraDefault, extraDesc, extraValues, extraText, "extra")) %>
                    <tr><th colspan="2">Process Table Entry</th></tr>
                    <tr>
                        <th class="right">Copy Table From</th>
                        <td><% print(tDefault.iopOtherTables(otherTables, "setTable", parseInt(tableEntry.fixed))) %></td>
                    </tr>
                    <% print(tDefault.iopTableTable(fullEntry, "tableEntry", parseInt(tableEntry.fixed))) %>
                </table>
                </form>
        </script>
        <script type="text/template" id="DeviceProcessListTemplate">
                <table id="processTable" style="width: 100%;">
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


