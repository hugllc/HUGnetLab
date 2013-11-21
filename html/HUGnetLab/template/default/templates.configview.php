<!--  These are our tempaltes -->
        <script type="text/template" id="DeviceConfigViewTitleTemplate">
            Device <%= DeviceID %>:<%= DeviceName %>
        </script>
        <script type="text/template" id="DeviceConfigViewTemplate">
                <form id="deviceForm" method="POST" action="javascript:void(0);">
                <div class="buttons floatright">
                    <button class="close">Close</button>
                </div>
                <div id="image">
                </div>
                <table style="width:100%;">
                    <tr>
                        <td colspan="2">
                            <table style="width:100%;">
                                <tr>
                                    <th>Data Channels</th>
                                    <th>Control Channels</th>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">
                                        <%= dataChannels %>
                                    </td>
                                    <td style="vertical-align: top;">
                                        <%= controlChannels %>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                </form>
        </script>
