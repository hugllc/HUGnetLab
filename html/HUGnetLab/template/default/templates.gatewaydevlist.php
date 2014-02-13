<!--  These are our templates -->
        <script type="text/template" id="GatewayDeviceListTemplate">
            <div id="gatewaydevicelist">
            </div>
        </script>
        <script type="text/template" id="GatewayDeviceListHeaderTemplate">
                        <%= id %>: <%= name %>
        </script>
        <script type="text/template" id="GatewayListDeviceHeaderTemplate">
                <thead>
                <tr>
                    <th class="sorter-false">Actions</th>
                    <th class="sorter-hex">ID</th>
                    <th class="sorter-text">Name</th>
                    <th class="sorter-text">Job</th>
                    <th class="sorter-text">Location</th>
                    <th class="sorter-text">Gateway</th>
                    <th class="sorter-text">Active</th>
                    <th class="sorter-numeric">Data Int<br />(Sec)</th>
                    <th class="sorter-usLongDate">Last History</th>
                    <th class="sorter-usLongDate">Last Poll</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
        </script>
        <script type="text/template" id="GatewayListDeviceViewEntryTemplate">
                        <td>
                            <button class="view">View</button>
                            <button class="export">Export</button>
                        </td>
                        <td class="center"><%= DeviceID %></td>
                        <td>
                            <%= DeviceName %>
                            <%
                                if (params.InfoLink) {
                                    print('<a class="info" href="'+params.InfoLink+'" target="_blank"></a>');
                                }
                            %>
                        </td>
                        <td><%= DeviceJob %></td>
                        <td><%= DeviceLocation %></td>
                        <td class="center"><%= GatewayKey %></td>
                        <td class="center"><% (Active == 1) ? print('Yes') : print('No'); %></td>
                        <td class="center"><%= PollInterval %></td>
                        <td>
                            <%= formatDate(localParams.LastHistory) %>
                        </td>
                        <td>
                            <span class="<% (LatePoll) ? print('error') : print(''); %>">
                                <%= formatDate(params.LastPoll) %>
                            </span>
                        </td>
        </script>
