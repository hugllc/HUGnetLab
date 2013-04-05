<!--  These are our tempaltes -->
        <script type="text/template" id="DatacollectorListTemplate">
                <table id="devTable" class="tablesorter">
                    <thead>
                    <tr>
                        <th class="{sorter: false}">Actions</th>
                        <th class="{sorter: 'text'}">Gateway</th>
                        <th class="{sorter: 'text'}">Name</th>
                        <th class="{sorter: 'text'}">IP</th>
                        <th class="{sorter: 'text'}">Last Contact</th>
                    </tr>
                    </thead>
                    <tbody id="DeviceListView">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="DatacollectorListEntryTemplate">
                        <td>
                            <!--
                            <button class="view">View</button>
                            <button class="export">Export</button>
                            -->
                        </td>
                        <td class="center"><%= GatewayKey %></td>
                        <td><%= name %></td>
                        <td><%= ip %></td>
                        <td><%= formatDate(LastContact) %></td>
        </script>
