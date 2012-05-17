<!--  These are our tempaltes -->
        <script type="text/template" id="TestPropertiesTitleTemplate">
            Test <%= id %>:<%= name %>
        </script>
        <script type="text/template" id="TestPropertiesTemplate">
                <form id="deviceForm" method="POST" action="javascript:void(0);">
                <table style="width:100%;">
                    <tr class="even"><th>Test #</th><td><%= id %></td></tr>
                    <tr class="odd">
                        <th>Name</th>
                        <td><input type="text" class="name" value="<%= name %>"/></td>
                    </tr>
                    <tr class="even">
                        <th>Notes</th>
                        <td><textarea class="notes"><%= notes %></textarea></td>
                    </tr>
                </table>
                <div>
                    <button class="save">Save</button>
                </div>
                </form>
        </script>
        <script type="text/template" id="TestListTemplate">
                <div>
                    <button class="new">New Test</button>
                </div>
                <table id="devTable" class="tablesorter">
                    <thead>
                    <tr>
                        <th class="{sorter: false}">Actions</th>
                        <th class="{sorter: 'numeric'}">#</th>
                        <th class="{sorter: 'text'}">Name</th>
                        <th class="{sorter: 'text'}">Created</th>
                        <th class="{sorter: 'text'}">Last Modified</th>
                    </tr>
                    </thead>
                    <tbody id="TestList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="TestEntryTemplate">
                        <td>
                            <button class="properties">View</button>
                        </td>
                        <td><%= id %></td>
                        <td><%= name %></td>
                        <td><%= created %></td>
                        <td><%= modified %></td>
        </script>
