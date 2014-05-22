<!--  These are our tempaltes -->
        <script type="text/template" id="ImageListViewTemplate">
                <form id="imageConfigListForm" method="POST" action="javascript:void(0);">
                <table id="imageConfigTable" class="tablesorter {sortlist: [[1,0]]}">
                    <thead>
                    <tr>
                        <th class="sorter-false" width="5%">Actions</th>
                        <th class="sorter-numeric" width="5%" class="center">ID</th>
                        <th class="sorter-text">Name</th>
                        <th class="sorter-text">Size</th>
                        <th class="sorter-text">Desc</th>
                        <th class="sorter-text">Points</th>
                    </tr>
                    </thead>
                    <tbody id="ImagesList">
                    </tbody>
                </table>
                </form>
        </script>
        <script type="text/template" id="ImageListViewEntryTemplate">
                    <td>
                        <button class="view">View</button>
                    </td>
                    <td class="center"><%= id %></td>
                    <td><%= name %></td>
                    <td><%= width %>x<%= height %></td>
                    <td><%= desc %></td>
                    <td><%= length %></td>
        </script>

        <!--  These are our tempaltes -->
        <script type="text/template" id="ImagesPropertiesTitleTemplate">
            Image <%= id %>:<%= name %>
        </script>
        <script type="text/template" id="ImagesPropertiesTemplate">
            <div>
                <form style="margin-left: 3em;" id="insertImage" enctype="multipart/form-data" action="javascript:void(0);" method="POST">
                    <!-- MAX_FILE_SIZE must precede the file input field -->
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                    <!-- Name of input element determines name in $_FILES array -->
                    <input type="button" class="insertImage" value="Insert Image" />
                    </span><input name="import" type="file" />
                </form>
            </div>
            <div align="center">
                <%= svg %>
            </div>
            <div>
                <form id="imageForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="ApplyImages">Save</button>
                    <button class="SaveImages">Save & Close</button>
                    <button class="insertPoint">Insert Point</button>
                </div>
                <table style="width: 100%; clear: both;">
                    <tbody>
                    <tr>
                        <th class="right">ID</th>
                        <td>
                            <%= id %>
                        </td>
                    </tr>
                    <tr>
                        <th title="The name you want to call this image" class="right">Name</th>
                        <td>
                            <input type="text" name="name" value="<%= name %>"/>
                        </td>
                    </tr>
                    <tr>
                        <th title="A description of what is in the image" class="right">Description</th>
                        <td>
                            <textarea name="desc" class="desc" class="left"><%= desc %></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th title="Data and text points in the image" class="center" colspan="2">Points</th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table>
                                <tr>
                                    <th>#</th>
                                    <th title="The text before the value (Can be empty)">Pretext</th>
                                    <th title="The text after the value (Can be empty)">Posttext</th>
                                    <th title="The font size to use">Font Size</th>
                                    <th title="The x value">X</th>
                                    <th title="The y value">Y</th>
                                    <th title="The device ID to get data from (Can be empty)">Device ID</th>
                                    <th title="The datachan on the device to get data from (Can be 'Date')">Channel</th>
                                    <th title="Check this to show units">Units</th>
                                    <th title="The color of the text">Text Color</th>
                                    <th title="The color of the background">Background</th>
                                    <th title="Check to delete this data point">Delete</th>
                                </tr>
<% _.each(points, function(point, index) { %>
                                <tr rowindex="<%= index %>" class="datapoint">
                                    <td class="center">
                                        <%= index %>
                                    </td>
                                    <td class="center">
                                        <input type="text" size="10" value="<%= point.pretext %>" name="pretext" />
                                    </td>
                                    <td class="center">
                                        <input type="text" size="10" value="<%= point.posttext %>" name="posttext" />
                                    </td>
                                    <td class="center">
                                        <select name="fontsize">
                                            <% for (var i=9;i<32;i++) { %>
                                                <option value="<%= i %>" <% if (i == point.fontsize) print('selected="selected"'); %>><%= i %></option>
                                            <% } %>
                                        </select>
                                    </td>
                                    <td class="center">
                                        <input type="text" size="4" value="<%= point.x %>" name="x" />
                                    </td>
                                    <td class="center">
                                        <input type="text" size="4" value="<%= point.y %>" name="y" />
                                    </td>
                                    <td class="center">
                                        <input type="text" size="6" value="<%= point.devid %>" name="devid" />
                                    </td>
                                    <td class="center">
                                        <input type="text" size="2" value="<%= point.datachan %>" name="datachan" />
                                    </td>
                                    <td class="center">
                                        <input type="checkbox" name="units" <% if (point.units == 1) print('checked="checked"'); %>/>
                                    </td>
                                    <td class="center">
                                        <input type="text" size="7" value="<%= point.color %>" name="color" />
                                    </td>
                                    <td class="center">
                                        <input type="text" size="7" value="<%= point.background %>" name="background" />
                                    </td>
                                    <td class="center">
                                        <input type="checkbox" name="delete" />
                                    </td>
                                </tr>
<% }); %>
                            </table>
                        </th>
                    </tr>
                </table>
                </form>
            </div>
        </script>
<script type="text/template" id="ImageViewTemplate">
        <form id="imageForm" method="POST" action="javascript:void(0);">
        <h2>
            Image: "<%= name %>"
        </h2>
        <div>
            <label for="before" class="bold">On or Before </label><input id="before" type="text" class="before" value="<%= beforeDate %>" />
            <select id="type">
                <% for (key in averageTypes) { %>
                    <option value="<%- key %>" <% (key == type) && print('selected="selected"'); %>>
                        <%= averageTypes[key] %>
                    </option>
                <% } %>
            </select>
            <input type="submit" name="submit" value="Go" />
            <label for="autorefresh" class="bold">Update with new data:</label><input id="autorefresh" type="checkbox" class="autorefresh" value="5" />
        </div>
        </form>
</script>
