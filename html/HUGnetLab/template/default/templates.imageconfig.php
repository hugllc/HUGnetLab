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
                <form id="sensorForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="SaveImageConfig">Save</button>
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
                </table>
                </form>
            </div>
        </script>
