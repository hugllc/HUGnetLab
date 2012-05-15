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
    <div>
        <form id="deviceForm" method="POST" action="javascript:void(0);">
        <div class="buttons floatright">
            <button class="SaveDevice">Save</button>
            <button class="cancel">Back to List</button>
        </div>
        <table style="width:100%;">
            <tr class="row0"><th>Serial #</th><td>{{id}}</td></tr>
            <tr class="row1"><th>Device ID</th><td>{{DeviceID}}</td></tr>
            <tr class="row0">
                <th>Name</th>
                <td><input type="text" class="DeviceName" value="{{DeviceName}}" /></td>
            </tr>
            <tr class="row1">
                <th>Location</th>
                <td><input type="text" class="DeviceLocation" value="{{DeviceLocation}}" /></td>
            </tr>
            <tr class="row0">
                <th>Job</th>
                <td><input type="text" class="DeviceJob" value="{{DeviceJob}}" /></td>
            </tr>
            <tr class="row1"><th>Hardware</th><td>{{HWPartNum}}</td></tr>
            <tr class="row0"><th>Firmware</th><td>{{FWPartNum}}</td></tr>
            <tr class="row1"><th>Version</th><td>{{FWVersion}}</td></tr>
            <tr class="row0"><th>Raw Setup</th><td>{{RawSetup}}</td></tr>
            {{#params}}
            <tr><th colspan="2">Properties</th></tr>
            <tr class="row0"><th>LastContact</th><td>{{LastContact}}</td></tr>
            {{/params}}
        </table>
        </form>
    </div>
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
