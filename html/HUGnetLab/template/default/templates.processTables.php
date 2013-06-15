<!--  These are our tempaltes -->
        <script type="text/template" id="ProcessTableListTemplate">
                <form id="processTableListForm" method="POST" action="javascript:void(0);">
                <div>
                    <button class="new">New Process Table</button>
                </div>
                <table id="processTableTable" class="tablesorter {sortlist: [[1,0]]}">
                    <thead>
                    <tr>
                        <th class="sorter-false">Actions</th>
                        <th class="sorter-numeric">ID</th>
                        <th class="sorter-text">Name</th>
                        <th class="sorter-text">Arch</th>
                        <th class="sorter-text">Desc</th>
                    </tr>
                    </thead>
                    <tbody id="ProcessTableList">
                    </tbody>
                </table>
                </form>
        </script>
        <script type="text/template" id="ProcessTableEntryTemplate">
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
        <script type="text/template" id="ProcessTablePropertiesTitleTemplate">
            Input Table <%= id %>:<%= name %>
        </script>
        <script type="text/template" id="ProcessTablePropertiesTemplate">
                <form id="sensorForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="SaveProcessTable">Save</button>
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
                                <% for (key in {"ADuC":"ADuC"}) { %>
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
                    <%
                    for (key in specs) {
                        var etext;
                        var efield = 'specs['+key+']';
                        var evalue = specs[key]['value'];
                        var valid  = specs[key]['valid'];
                        var size   = specs[key]['size']
                        etext  = '<tr>';
                        etext += '<th'+showInfo(specs[key]['longDesc'], key)+' class="right">'+specs[key]['desc']+'</th><td>';
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
