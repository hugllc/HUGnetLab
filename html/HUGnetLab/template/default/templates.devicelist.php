<!--  These are our templates -->
        <script type="text/template" id="DeviceListViewTemplate">
            <form id="devListForm" method="POST" action="javascript:void(0);">
            <div style="height: 2em;">
                <div style="float: right; clear: both;">
                    <label for="gatewayFilter" class="bold">Gateway:</label>
                    <select class="gatewayFilter">
                        <%
                    for (var q in gateways)
                    {
                        print('<option value="'+gateways[q].id+'"');
                        if (gateways[q].id == GatewayKey) {
                            print(' selected="selected" ');
                        }
                        print('>'+gateways[q].name+'</option>');
                    }
                    %>
                        <option value="any" <% (GatewayKey == "any") && print('selected="selected"'); %>>Any</option>
                        <option value="all" <% (GatewayKey == "all") && print('selected="selected"'); %>>All</option>
                    </select>
                    <label for="activeFilter" class="bold">Status:</label>
                    <select class="activeFilter">
                        <option value="">Any</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <label for="fieldFilter" class="bold">Field:</label>
                    <select class="fieldFilter">
                        <option value="DeviceName">Name</option>
                        <option value="DeviceJob">Job</option>
                        <option value="DeviceLocation">Location</option>
                        <option value="DeviceID">ID</option>
                    </select>
                    <label for="searchFilter" class="bold">Field:</label>
                    <input type="text" class="searchFilter" />
                    <button class="goFilter">Go</button>
                    <button class="resetFilter">Reset</button>
                </div>
            </div>
            <table id="devTable" class="tablesorter {sortlist: [[1,0]]}">
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
                <tbody id="DeviceListView">
                </tbody>
            </table>
            </form>
        </script>
        <script type="text/template" id="DeviceListViewEntryTemplate">
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
