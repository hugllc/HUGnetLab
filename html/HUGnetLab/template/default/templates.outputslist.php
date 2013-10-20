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
<script type="text/template" id="OutputsViewTemplate">
        <form id="outputsForm" method="POST" action="javascript:void(0);">
        </form>
        <div>
          <h3>Last Data Record:</h3>
          <div id="OutputsViewData">
          </div>
        </div>
        <div>
          <h3>Control Channels:</h3>
          <div id="OutputsControlChannelsDiv">
          </div>
        </div>
</script>
<script type="text/template" id="OutputsViewDataTemplate">
          <table>
            <tr>
              <th>Date</th>
          <%
            for (var key in dataChannels) {
                print(
                    '<th>'+dataChannels[key].label+' ('+dataChannels[key].units+')</th>'
                );
            }
          %>
            </tr>
            <tr>
              <td><%= sqlUTCDate(params.LastPollData.Date * 1000) %></td>
          <%
            for (var key in dataChannels) {
                print('<td align="center">'+params.LastPollData[key].value+'</td>');
            }
          %>
            </tr>
          </table>
</script>
<script type="text/template" id="OutputsControlChannelEntryTemplate">
              <th><%= label %></th>
              <td align="center"><%= value %></td>
              <td><input type="text" name="value" value="<% print(value + 0); %>" /></td>
</script>
<script type="text/template" id="OutputsControlChannelListTemplate">
          <table>
            <thead>
              <tr>
                <th>Channel</th><th>Current Value</th><th>New Value</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>

</script>
