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
                    <tr><th colspan="2">Fields</th></tr>
                    <tr><td colspan="2"><%= fields %></td></tr>
                </table>
                <div>
                    <button class="save">Save</button>
                </div>
                </form>
        </script>
        <script type="text/template" id="TestListTemplate">
                <h2 class="run stopped">
                    Tests are STOPPED.
                </h2>
                <h2 class="stop running">
                    Tests are RUNNING.
                </h2>
                <div>
                    <button class="new">New Test</button>
                    <button class="run">Run Tests</button>
                    <button class="stop">Stop Tests</button>
                </div>
                <table id="devTable" class="tablesorter">
                    <thead>
                    <tr>
                        <th class="{sorter: false}">Actions</th>
                        <th class="{sorter: 'numeric'}">Test ID</th>
                        <th class="{sorter: 'text'}">Name</th>
                        <th class="{sorter: 'text'}">Data Interval<br>(Seconds)</th>
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
                            <button class="view">View</button>
                        </td>
                        <td class="center"><%= DeviceID %></td>
                        <td><%= DeviceName %></td>
                        <td class="center"><%= PollInterval %></td>
                        <td><%= formatDate(params.Created) %></td>
                        <td><%= formatDate(params.LastModified) %></td>
        </script>
        <script type="text/template" id="TestFieldListTemplate">
                <table id="fieldTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th style="width: 5%;">Actions</th>
                        <th style="width: 5%;">#</th>
                        <th>Name</th>
                        <th style="width: 5%;">Device</th>
                        <th style="width: 5%;">Field</th>
                    </tr>
                    </thead>
                    <tbody class="here">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="TestFieldEntryTemplate">
                        <td><button class="properties">Edit</button></td>
                        <td class="center"><%= id %></td>
                        <td><%= name %></td>
                        <td class="center"><%= device %></td>
                        <td class="center"><%= field %></td>
        </script>
        <script type="text/template" id="TestFieldPropertiesTitleTemplate">
            Field <%= id %>:<%= name %>
        </script>
        <script type="text/template" id="TestFieldPropertiesTemplate">
                <form id="testFieldForm" method="POST" action="javascript:void(0);">
                <table style="width:100%;">
                    <tr class="odd">
                        <th>Name</th>
                        <td><input type="text" class="name" name="name" required="required" value="<%= name %>"/></td>
                    </tr>
                    <tr class="even">
                        <th>Device</th>
                        <td><input type="text" class="device" name="device" required="required" value="<%= device %>"/></td>
                    </tr>
                    <tr class="odd">
                        <th>Field</th>
                        <td><input type="text" class="field" name="field" required="required" value="<%= field %>"/></td>
                    </tr>
                </table>
                <div>
                    <button class="save">Save</button>
                </div>
                </form>
        </script>
