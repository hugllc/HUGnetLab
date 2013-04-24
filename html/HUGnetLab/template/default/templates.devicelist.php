<!--  These are our tempaltes -->
        <script type="text/template" id="DeviceListViewTemplate">
                <table id="devTable" class="tablesorter {sortlist: [[1,0]]}">
                    <thead>
                    <tr>
                        <th class="sorter-false">Actions</th>
                        <th class="sorter-hex">ID</th>
                        <th class="sorter-text">Name</th>
                        <th class="sorter-text">Active</th>
                        <th class="sorter-numeric">Data Int<br />(Sec)</th>
                        <th class="sorter-usLongDate">Last Contact</th>
                        <th class="sorter-usLongDate">Last Poll</th>
                    </tr>
                    </thead>
                    <tbody id="DeviceListView">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="DeviceListViewEntryTemplate">
                        <td>
                            <button class="view">View</button>
                            <button class="export">Export</button>
                        </td>
                        <td class="center"><%= DeviceID %></td>
                        <td><%= DeviceName %></td>
                        <td class="center"><% (Active == 1) ? print('Yes') : print('No'); %></td>
                        <td class="center"><%= PollInterval %></td>
                        <td>
                            <%= formatDate(params.LastContact) %>
                        </td>
                        <td>
                            <span class="<% (LatePoll) ? print('error') : print(''); %>">
                                <%= formatDate(params.LastPoll) %>
                            </span>
                        </td>
        </script>
