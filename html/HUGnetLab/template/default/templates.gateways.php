<!--  These are our tempaltes -->
        <script type="text/template" id="GatewayPropertiesTitleTemplate">
            Gateway <%= id %>:<%= name %>
        </script>
        <script type="text/template" id="GatewayPropertiesTemplate">
                <form id="deviceForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="SaveGateway save">Save</button>
                </div>
                <table style="width:100%;">
                    <tr class="even"><th class="right">ID</th><td><%= id %></td></tr>
                    <tr class="odd">
                        <th class="right">Name</th>
                        <td><input type="text" class="name" value="<%= name %>"/></td>
                    </tr>
                    <tr class="even">
                        <th class="right">Location</th>
                        <td><input type="text" class="location" value="<%= location %>" /></td>
                    </tr>
                    <tr class="odd">
                        <th class="right">Notes</th>
                        <td><input type="text" class="description" value="<%= description %>" /></td>
                    </tr>
                </table>
                </form>
        </script>
        <script type="text/template" id="GatewaysTemplate">
                <div>
                </div>
                <div style="clear:both;">
                <form id="deviceListForm" method="POST" action="javascript:void(0);">
                <table id="devTable" class="tablesorter {sortlist: [[2,0]]}">
                    <thead>
                    <tr>
                        <th class="sorter-false" width="10%">Actions</th>
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
        <script type="text/template" id="GatewayEntryTemplate">
                    <td>
                        <select class="action">
                            <option value="">Action</option>
                            <option value="properties">Edit</option>
                        </select>
                    </td>
                    <td class="center"><%= id %></td>
                    <td><%= name %></td>
                    <td><%= location %></td>
                    <td><%= description %></td>
        </script>


