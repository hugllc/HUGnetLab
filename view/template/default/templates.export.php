<!--
 * This is the template file
-->
<script type="text/template" id="ExportTemplate">
        <form id="exportForm" method="POST" action="javascript:void(0);">
        <h2>Export <%= DeviceName %> Data</h2>
        <p>
            <span style="font-weight: bold;">Note:</span>
            All dates in the CSV file will be UTC dates.
            The dates in the fields are in your local timezone.
        </p>
        <p>
            <span style="font-weight: bold;">Maximum Records Returned: </span> <%= csvlimit %>
        </p>
        <div>
            <div>
                <div>
                    <button class="minute30">30 Minutes</button>
                    <button class="minute240">4 Hours</button>
                    <button class="minute720">12 Hours</button>
                </div>
                <div>
                    <label for="since" class="bold">From </label><input id="since" type="text" class="since" value="<%= sinceDate %>" />
                    <label for="until" class="bold">To </label><input id="until" type="text" class="until" value="<%= untilDate %>" />
                </div>
                <div><button class="exportCSV">Export as CSV</button></div>
            </div>
        </div>
        </form>
</script>

