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
                        <td><input type="text" class="name" name="name" required="required" value="<%= name %>"/></td>
                    </tr>
                    <tr class="even">
                        <th>Notes</th>
                        <td><textarea class="notes" name="notes" rows="10"><%= notes %></textarea></td>
                    </tr>
                    <tr class="odd">
                        <th>Field Count</th>
                        <td>
                            <select class="fieldcount" name="fieldcount">
                                <%  var i;
                                    for (i = 1; i <= 10; i++) {
                                        print('<option value="' + i + '"');
                                        if (fieldcount == i) print(' selected="selected"');
                                        print('>' + i + '</option>');
                                    }
                                %>
                            </select>
                        </td>
                    </tr>
                    <%  var i;
                        for (i = 0; i < fieldcount; i++) { %>
                    <tr><th colspan="2">Field <%= (i+1) %></th></tr>
                    <tr class="<% if (i % 0) { print('odd'); } else { print('even'); } %>">
                        <th>Name</th>
                        <td><input type="text" name="fields<%= i %>name" size="10" value="<%= fields[i]['name'] %>" /></td>
                    </tr>
                    <tr class="<% if (i % 0) { print('even'); } else { print('odd'); } %>">
                        <th>DeviceID</th>
                        <td><input type="text" name="fields<%= i %>device" size="10" value="<%= fields[i]['device'] %>" /></td>
                    </tr>
                    <tr class="<% if (i % 0) { print('odd'); } else { print('even'); } %>">
                        <th>Field</th>
                        <td><input type="text" name="fields<%= i %>field" size="10" value="<%= fields[i]['field'] %>" /></td>
                    </tr>
                    <%  }  %>
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
                            <button class="properties">Edit</button>
                            <button class="run">Run</button>
                            <button class="view">View</button>
                        </td>
                        <td><%= id %></td>
                        <td><%= name %></td>
                        <td><%= created %></td>
                        <td><%= modified %></td>
        </script>
