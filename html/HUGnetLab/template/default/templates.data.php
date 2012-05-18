<!--
 * This is the template file
-->
<script type="text/template" id="DataPointTemplate">
            <td class="<%= fieldClass %>"><%= data %></td>
</script>

<script type="text/template" id="DataPointListRunTemplate">
        <form id="pollForm" method="POST" action="javascript:void(0);">
        <h2>Run Test <%= id %></h2>
        <button class="startPoll">Start Polling</button>
        <button class="stopPoll">Stop Polling</button>
        <table id="devTable">
            <thead>
            <tr>
                <%= header %>
            </tr>
            </thead>
            <tbody id="DataPointList">
            </tbody>
        </table>
        </form>
</script>
<script type="text/template" id="DataPointListViewTemplate">
        <form id="pollForm" method="POST" action="javascript:void(0);">
        <h2>View Test <%= id %></h2>
        <div class="floatright">
            <div>
                <span class="bold">Refresh:</span><input type="checkbox" class="autorefresh" value="5" />
            </div>
        </div>
        <table id="devTable">
            <thead>
            <tr>
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
