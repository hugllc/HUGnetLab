<!--
 * This is the template file
-->
<script type="text/template" id="DeviceListTemplate">
    <table>
        <tr>
            <th>Actions</th>
            <th>Name</th>
            <th>ID</th>
            <th>Serial #</th>
            <th>Hardware</th>
            <th>Firmware</th>
        </tr>
    {{#devices}}
        <tr>
            <td>{{{actions}}}</td>
            <td>{{DeviceName}}</td>
            <td>{{id}}</td>
            <td>{{DeviceID}}</td>
            <td>{{HWPartNum}}</td>
            <td>{{FWPartNum}} {{FWVersion}}</td>
        </tr>
    {{/devices}}
    </table>
</script>
<script type="text/template" id="DevicePropertiesTemplate">
    <th>Serial #</th><td>{{id}}</td>
    <th>Device ID</th><td>{{DeviceID}}</td>
    <th>Name</th><td>{{DeviceName}}</td>
    <th>Hardware</th><td>{{HWPartNum}}</td>
    <th>Firmware</th><td>{{FWPartNum}}</td>
    <th>Version</th><td>{{FWVersion}}</td>
    <th>Raw Setup</th><td>{{RawSetup}}</td>
    <th>Serial #</th><th><td>{{actions}}</td>
</script>
