<!--  These are our templates -->
        <script type="text/template" id="GatewayListTemplate">
                <div>
                </div>
                <div style="clear:both;">
                <form id="deviceListForm" method="POST" action="javascript:void(0);">
                <table id="devTable" class="tablesorter {sortlist: [[2,0]]}">
                    <thead>
                    <tr>
                        <th class="sorter-numeric" width="5%">id</th>
                        <th class="sorter-text">Name</th>
                        <th class="sorter-text">Location</th>
                        <th class="sorter-text">Description</th>
                    </tr>
                    </thead>
                    <tbody id="GatewayList">
                    </tbody>
                </table>
                </form>
                </div>
        </script>
        <script type="text/template" id="GatewayListEntryTemplate">
                    <td class="center"><%= id %></td>
                    <td><%= name %></td>
                    <td><%= location %></td>
                    <td><%= description %></td>
        </script>
