<!--  These are our tempaltes -->
        <script type="text/template" id="PowerTableListTemplate">
                <form id="powerTableListForm" method="POST" action="javascript:void(0);">
                <div>
                    <button class="new">New Power Table</button>
                </div>
                <table id="powerTableTable" class="tablesorter {sortlist: [[1,0]]}">
                    <thead>
                    <tr>
                        <th class="sorter-false">Actions</th>
                        <th class="sorter-numeric">ID</th>
                        <th class="sorter-text">Name</th>
                        <th class="sorter-text">Arch</th>
                        <th class="sorter-text">Desc</th>
                    </tr>
                    </thead>
                    <tbody id="PowerTableList">
                    </tbody>
                </table>
                </form>
        </script>
        <script type="text/template" id="PowerTableEntryTemplate">
                    <td>
                        <select class="action">
                            <option value="">Action</option>
                            <option value="properties">Edit</option>
                        </select>
                    </td>
                    <td class="center"><%= id %></td>
                    <td class="center"><%= name %></td>
                    <td class="center"><%= arch %></td>
                    <td class="center"><%= desc %></td>
        </script>

        <!--  These are our tempaltes -->
        <script type="text/template" id="PowerTablePropertiesTitleTemplate">
            Power Table <%= id %>:<%= name %>
        </script>
        <script type="text/template" id="PowerTablePropertiesTemplate">
                <form id="sensorForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="SavePowerTable">Save</button>
                </div>
                <table style="width: 100%;">
                    <tbody>
                    <tr>
                        <th class="right">ID</th>
                        <td>
                            <%= id %>
                        </td>
                    </tr>
                    <tr>
                        <th title="The name you want to call this table" class="right">Name</th>
                        <td>
                            <input type="text" name="name" value="<%= name %>"/>
                        </td>
                    </tr>
                    <tr>
                        <th title="The architecture this table is for" class="right">Arch</th>
                        <td>
                            <select name="arch" class="type">
                                <% for (key in archs) { %>
                                    <option value="<%- key %>" <% (key == arch) && print('selected="selected"'); %>>
                                        <%= key %>
                                    </option>
                                <% } %>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th title="A description of what is in the table" class="right">Description</th>
                        <td>
                            <textarea name="desc" class="desc" class="left"><%= desc %></textarea>
                        </td>
                    </tr>
                    <!-- Sensor Extra Parameters -->
                    <% print(tDefault.iopTableTable(params, "params")) %>
                    </tr>
                </table>
                </form>
        </script>
