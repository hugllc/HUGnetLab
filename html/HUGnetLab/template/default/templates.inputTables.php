<!--  These are our tempaltes -->
        <script type="text/template" id="InputTableListTemplate">
                <form id="inputTableListForm" method="POST" action="javascript:void(0);">
                <div>
                    <button class="new">New Input Table</button>
                </div>
                <table id="inputTableTable" class="tablesorter {sortlist: [[1,0]]}">
                    <thead>
                    <tr>
                        <th class="sorter-false">Actions</th>
                        <th class="sorter-numeric">ID</th>
                        <th class="sorter-text">Name</th>
                        <th class="sorter-text">Type</th>
                        <th class="sorter-text">Desc</th>
                    </tr>
                    </thead>
                    <tbody id="InputTableList">
                    </tbody>
                </table>
                </form>
        </script>
        <script type="text/template" id="InputTableEntryTemplate">
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
        <script type="text/template" id="InputTablePropertiesTitleTemplate">
            Input Table <%= id %>:<%= name %>
        </script>
        <script type="text/template" id="InputTablePropertiesTemplate">
                <form id="sensorForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="SaveInputTable">Save</button>
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
                        <th class="right">Name</th>
                        <td>
                            <input type="text" name="name" value="<%= name %>"/>
                        </td>
                    </tr>
                    <tr>
                        <th class="right">Type</th>
                        <td>
                            <select name="arch" class="type">
                                <% for (key in archs) { %>
                                    <option value="<%- key %>" <% (key == arch) && print('selected="selected"'); %>>
                                        <%= archs[key] %>
                                    </option>
                                <% } %>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="right">Description</th>
                        <td>
                            <textarea name="desc" class="desc" class="left"><%= desc %></textarea>
                        </td>
                    </tr>
                    <!-- Sensor Extra Parameters -->
                    <%
                    for (key in params) {
                        var etext;
                        var efield = 'params['+key+']';
                        var evalue = params[key]['value'];
                        var valid  = params[key]['valid'];
                        var size   = params[key]['size']
                        etext  = '<tr>';
                        etext += '<th class="right">'+params[key]['desc']+'</th><td>';
                        if (!isNaN(size)) {
                            etext += '<input type="text" name="'+efield+'" '
                                + 'value="' + evalue + '" size="'+(size+2)+'" maxlength="'+size+'"/>';
                        } else if (typeof valid === 'object') {
                            etext += '<select name="'+efield+'" >';
                            for (q in valid)
                            {
                                etext += '<option value="'+q.replace('&', '&amp;')+'"';
                                if (q == evalue) {
                                    etext += ' selected="selected" ';
                                }
                                etext += '>'+valid[q]+'</option>';
                            }
                            etext += '</select>';
                        } else {
                            etext += evalue;
                        }
                        etext += '</td></tr>';
                        print(etext);
                    }
                    %>
                    </tr>
                </table>
                </form>
        </script>
