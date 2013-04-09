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
        <h2>View Test <%= DeviceName %></h2>
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
                    <label for="until" class="bold">To </label><input id="until" type="text" class="until" value="<%= untilDate %>" />
                    <select id="type">
                        <% for (key in averageTypes) { %>
                            <option value="<%- key %>" <% (averageTypes[key] == type) && print('selected="selected"'); %>>
                                <%= averageTypes[key] %>
                            </option>
                        <% } %>
                    </select>
                    <input type="submit" name="submit" value="Go" />
                </div>
            </div>
        </div>
        </form>
        <div>
            <span class="bold">Records:</span> <span id="data-records">0</span>
        </div>
</script>

