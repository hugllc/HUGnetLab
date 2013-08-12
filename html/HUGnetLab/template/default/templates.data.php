<!--
 * This is the template file
-->
<script type="text/template" id="DataPointHeaderTemplate">
            <th><%= header %></th>
</script>

<script type="text/template" id="DataPointTemplate">
            <td class="<%= fieldClass %>"><%= data %></td>
</script>

<script type="text/template" id="DataViewTemplate">
        <form id="pollForm" method="POST" action="javascript:void(0);">
        <%
            if (params.ImageURL) {
                var ImageURL = '<img src="'+params.ImageURL+'" class="experiment" alt="Experiment Log" title="Experiment Log"/>';
            } else {
                var ImageURL = '';
            }
            if (params.LogURL) {
                print('<div><a href="'+params.LogURL+'" target="_blank">'+((ImageURL == "") ? 'Experiment Log' : ImageURL)+'</a></div>');
            } else {
                print(ImageURL);
            }
        %>
        <div>
            <%
                if (params.InfoLink) {
                    print('<a class="info" href="'+params.InfoLink+'" target="_blank"></a>');
                }
            %>
            <h2>
                View Test <%= DeviceName %>
            </h2>
            <h3>
                <% (DeviceLocation.length > 0) ? print(DeviceLocation) : print(""); %>
            </h3>
            <h3>
                <% (DeviceJob.length > 0) ? print(DeviceJob) : print(""); %>
            </h3>
        </div>
        <div>
            <div>
                <div><button class="exportCSV">Export as CSV</button></div>
                <div><label for="autorefresh" class="bold">Update with new data:</label><input id="autorefresh" type="checkbox" class="autorefresh" value="5" /></div>
                <div>
                    <label for="setPeriod" class="bold">Period Length:</label>
                    <select id="setPeriod">
                        <option value="0">Custom</option>
                        <option value="15">15 Minutes</option>
                        <option value="30">30 Minutes</option>
                        <option value="45">45 Minutes</option>
                        <option value="60">60 Minutes</option>
                        <option value="120">2 Hours</option>
                        <option value="240">4 Hours</option>
                        <option value="480">8 Hours</option>
                        <option value="720">12 Hours</option>
                        <option value="1440">24 Hours</option>
                    </select>
                </div>
                <div>
                    <label for="since" class="bold">From </label><input id="since" type="text" class="since" value="<%= sinceDate %>" />
                </div>
                <div>
                    <label for="until" class="bold">To </label><input id="until" type="text" class="until" value="<%= untilDate %>" />
                </div>
                <div>
                    <select id="type">
                        <% for (key in averageTypes) { %>
                            <option value="<%- key %>" <% (key == type) && print('selected="selected"'); %>>
                                <%= averageTypes[key] %>
                            </option>
                        <% } %>
                    </select>
                </div>
                <div>
                    <input type="submit" name="submit" value="Go" />
                </div>
            </div>
        </div>
        </form>
        <div>
            <span class="bold">Records:</span> <span id="data-records">0</span>
        </div>
</script>

