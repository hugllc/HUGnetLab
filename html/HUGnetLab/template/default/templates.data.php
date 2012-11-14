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
                    <button class="minute30">30 Minutes</button>
                    <button class="minute240">4 Hours</button>
                    <button class="minute720">12 Hours</button>
                </div>
                <div>
                    <label for="since" class="bold">From </label><input id="since" type="text" class="since" value="<%= sinceDate %>" />
                    <label for="until" class="bold">To </label><input id="until" type="text" class="until" value="<%= untilDate %>" />
                    <select id="type">
                        <option value="30SEC">30 Second Average</option>
                        <option value="1MIN">1 Minute Average</option>
                        <option value="5MIN">5 Minute Average</option>
                        <option value="15MIN">15 Minute Average</option>
                        <option value="history">History</option>
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

