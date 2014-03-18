<!--  These are our tempaltes -->
        <script type="text/template" id="ImageConfigListTemplate">
                <form id="imageConfigListForm" method="POST" action="javascript:void(0);">
                <div>
                    <button class="new">New Image</button>
                </div>
                <table id="imageConfigTable" class="tablesorter {sortlist: [[1,0]]}">
                    <thead>
                    <tr>
                        <th class="sorter-false">Actions</th>
                        <th class="sorter-numeric">ID</th>
                        <th class="sorter-text">Name</th>
                        <th class="sorter-text">Size</th>
                        <th class="sorter-text">Desc</th>
                    </tr>
                    </thead>
                    <tbody id="ImageConfigList">
                    </tbody>
                </table>
                </form>
        </script>
        <script type="text/template" id="ImageConfigEntryTemplate">
                    <td>
                        <select class="action">
                            <option value="">Action</option>
                            <option value="properties">Edit</option>
                        </select>
                    </td>
                    <td class="center"><%= id %></td>
                    <td class="center"><%= name %></td>
                    <td class="center"><%= height %>x<%= width %></td>
                    <td class="center"><%= desc %></td>
        </script>

        <!--  These are our tempaltes -->
        <script type="text/template" id="ImageConfigPropertiesTitleTemplate">
            Image <%= id %>:<%= name %>
        </script>
        <script type="text/template" id="ImageConfigPropertiesTemplate">
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
                <input type="button" class="insertPoint" value="Insert Point" />
                <div class="buttons floatright">
                    <button class="SaveImageConfig">Save</button>
                    <button class="ApplyImageConfig">Apply</button>
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
                                    <th title="The text before the value">Pretext</th>
                                    <th title="The text after the value">Posttext</th>
                                    <th title="The x value">X</th>
                                    <th title="The y value">Y</th>
                                    <th title="The color of the text">Text Color</th>
                                    <th title="The color of the background">Background Color</th>
                                </tr>
<% _.each(points, function(point, index) { %>
                                <tr rowindex="<%= index %>" class="datapoint">
                                    <td>
                                        <%= index %>
                                    </td>
                                    <td>
                                        <input type="text" size="10" value="<%= point.pretext %>" id="pretext" />
                                    </td>
                                    <td>
                                        <input type="text" size="10" value="<%= point.posttext %>" id="posttext" />
                                    </td>
                                    <td>
                                        <input type="text" size="10" value="<%= point.x %>" id="x" />
                                    </td>
                                    <td>
                                        <input type="text" size="10" value="<%= point.y %>" id="y" />
                                    </td>
                                    <td>
                                        <input type="text" size="10" value="<%= point.color %>" id="color" />
                                    </td>
                                    <td>
                                        <input type="text" size="10" value="<%= point.background %>" id="background" />
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
