<!--
 * This is the template file
-->
<script type="text/template" id="DataPointEntryTemplate">
            <td><%= Date %></td>
            <td><%= DataIndex %></td>
</script>

<script type="text/template" id="DataPointTemplate">
            <td><%= data %></td>
</script>

<script type="text/template" id="DataPointListTemplate">
        <form id="pollForm" method="POST" action="javascript:void(0);">
        <button class="startPoll">Start Polling</button>
        <button class="stopPoll">Stop Polling</button>
        <button class="reset">Reset Data</button>
        <br />Pause: <input type="text" size="5" id="<%= pauseID %>" value="<%= pause %>" /> s between polls
        <table id="devTable">
            <thead>
            <tr>
                <th>Date</th>
                <th>Index</th>
                <%= header %>
            </tr>
            </thead>
            <tbody id="DataPointList">
            </tbody>
        </table>
        </form>
</script>

<script type="text/template" id="DataPointHeaderTemplate">
            <th><%= header %></th>
</script>
