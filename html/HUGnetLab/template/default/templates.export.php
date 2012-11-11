<!--
 * This is the template file
-->
<script type="text/template" id="ExportTemplate">
        <form id="exportForm" method="POST" action="javascript:void(0);">
        <h2>Export <%= DeviceName %> Data</h2>
        <p>
            <span class="bold">Note:</span>
            All dates in the CSV file will be UTC dates.
            The dates in the fields are in your local timezone.
        </p>
        <p>
            <span class="bold">Maximum Records Returned: </span> <%= csvlimit %>
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
                <div>
                    <label for="order" class="bold">Order: </label>
                    <select id="order">
                        <option value="1">Date Descending</option>
                        <option value="0">Date Ascending</option>
                    <select>
                </div>
                <div><button class="exportCSV">Export as CSV</button></div>
            </div>
        </div>
        <p>
            <span class="bold">CSV URL: </span> <span id="csvurl"><%= csvurl %></span>
        </p>
        </form>
</script>

