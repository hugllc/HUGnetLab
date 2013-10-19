<!--  These are our tempaltes -->
        <script type="text/template" id="OutputsListTemplate">
                <table id="devTable" class="tablesorter {sortlist: [[1,0]]}">
                    <thead>
                    <tr>
                        <th class="sorter-false">Actions</th>
                        <th class="sorter-hex">Test ID</th>
                        <th class="sorter-text">Name</th>
                        <th class="sorter-text">Data Interval<br>(Seconds)</th>
                        <th class="sorter-text">Created</th>
                        <th class="sorter-text">Last Poll</th>
                    </tr>
                    </thead>
                    <tbody id="TestList">
                    </tbody>
                </table>
        </script>
        <script type="text/template" id="OutputsListEntryTemplate">
                        <td>
                            <button class="view">View</button>
                        </td>
                        <td class="center"><%= DeviceID %></td>
                        <td>
                            <%= DeviceName %>
                            <%
                                if (params.InfoLink) {
                                    print('<a class="info" href="'+params.InfoLink+'" target="_blank"></a>');
                                }
                            %>
                        </td>
                        <td class="center"><%= PollInterval %></td>
                        <td><%= formatDate(params.Created) %></td>
                        <td>
                            <span class="<% (LatePoll) ? print('error') : print(''); %>">
                                <%= formatDate(params.LastPoll) %>
                            </span>
                        </td>
        </script>
