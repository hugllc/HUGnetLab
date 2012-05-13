<!--
 * This is the template file
-->
<script type="text/template" id="deviceRow">
    <td>{{{actions}}}</td>
    <td>{{id}}</td>
    <td>{{DeviceID}}</td>
    <td>{{DeviceName}}</td>
    <td>{{HWPartNum}}</td>
    <td>{{FWPartNum}} {{FWVersion}}</td>
</script>
<script type="text/template" id="deviceProperties">
    <th>Serial #</th><td>{{id}}</td>
    <th>Device ID</th><td>{{DeviceID}}</td>
    <th>Name</th><td>{{DeviceName}}</td>
    <th>Hardware</th><td>{{HWPartNum}}</td>
    <th>Firmware</th><td>{{FWPartNum}}</td>
    <th>Version</th><td>{{FWVersion}}</td>
    <th>Raw Setup</th><td>{{RawSetup}}</td>
    <th>Serial #</th><th><td>{{actions}}</td>
</script>
