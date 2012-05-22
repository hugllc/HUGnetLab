<!--
 * This is the template file
-->
<script type="text/template" id="DataPointHeaderTemplate">
            <th><%= header %></th>
</script>

<script type="text/template" id="DataPointTemplate">
            <td class="<%= fieldClass %>"><%= data %></td>
</script>

<script type="text/template" id="DataPollTemplate">
        <form id="pollForm" method="POST" action="javascript:void(0);">
        <h2>Run Test <%= id %></h2>
        <button class="startPoll">Start Polling</button>
        <button class="stopPoll">Stop Polling</button>
        </form>
</script>
<script type="text/template" id="DataViewTemplate">
        <form id="pollForm" method="POST" action="javascript:void(0);">
        <h2>View Test <%= id %></h2>
        <div>
            <div>
                <div><label for="autorefresh" class="bold">Refresh:</label><input id="autorefresh" type="checkbox" class="autorefresh" value="5" /></div>
                <div><label for="datarows" class="bold">Rows:</label><input id="datarows" type="input" class="datarows" value="<%= limit %>" /></div>
            </div>
        </div>
        </form>
</script>

