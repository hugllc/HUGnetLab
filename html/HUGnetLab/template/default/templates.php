<!--
 * This is the template file
-->
<script type="text/template" id="DeviceEntryTemplate">
            <td>
                <button class="properties">View</button>
                <button class="refresh">Refresh</button>
            </td>
            <td>{{DeviceName}}</td>
            <td>{{DeviceID}}</td>
            <td>{{id}}</td>
            <td>{{HWPartNum}}</td>
            <td>{{FWPartNum}} {{FWVersion}}</td>
</script>
<script type="text/template" id="DevicePropertiesTemplate">
        <table>
            <tr><th>Serial #</th><td>{{id}}</td></tr>
            <tr><th>Device ID</th><td>{{DeviceID}}</td></tr>
            <tr><th>Name</th><td>{{DeviceName}}</td></tr>
            <tr><th>Hardware</th><td>{{HWPartNum}}</td></tr>
            <tr><th>Firmware</th><td>{{FWPartNum}}</td></tr>
            <tr><th>Version</th><td>{{FWVersion}}</td></tr>
            <tr><th>Raw Setup</th><td>{{RawSetup}}</td></tr>
            <tr><th>Action</th><td><button class="cancel">Back to List</button></td></tr>
        </table>
</script>
<script type="text/template" id="DeviceListTemplate">
        <table id="devTable" class="tablesorter">
            <thead>
            <tr>
                <th class="{sorter: false}">Actions</th>
                <th class="{sorter: 'text'}">Name</th>
                <th class="{sorter: 'text'}">ID</th>
                <th class="{sorter: 'numeric'}">Serial #</th>
                <th class="{sorter: 'text'}">Hardware</th>
                <th class="{sorter: 'text'}">Firmware</th>
            </tr>
            </thead>
            <tbody id="DeviceList">
            </tbody>
        </table>
</script>
