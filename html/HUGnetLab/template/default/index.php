<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>
            {{title}}
        </title>
        <link rel="stylesheet" href="HUGnetLab/template/default/default.css" />
        <link rel="stylesheet" href="HUGnetLab/template/default/theme.default.css" />
        <link rel="stylesheet" href="HUGnetLab/template/default/jquery.jqplot.css" />
        <link rel="stylesheet" href="HUGnetLab/template/default/pepper-grinder/jquery-ui.css" />
        <script src="/HUGnetLib/contrib.js" type="text/javascript"></script>
        <script src="/HUGnetLib/hugnet.js" type="text/javascript"></script>
        <!-- This default.js must be loaded before hugnetlab.js.  It loads the underscore templates -->
        <script src="HUGnetLab/template/default/default.js" type="text/javascript"></script>
        <script src="HUGnetLab/hugnetlab.js" type="text/javascript"></script>
        <script type="text/javascript">
{{{params}}}
        </script>
{{header}}
    </head>
    <body>
        <header>
            <div id="header">
                <div class="clock"><span class="bold">UTC Time: </span><span id="UTCClock"></span></div>
                <h1 class="header">{{title}}</h1>
            </div>
        </header>
        <section>
        <div class="body">
            <div id="tabs">
                <nav>
                <ul>
                    {{#view}}
                    <li><a href="#tabs-view">Devices</a></li>
                    {{#images}}<li><a href="#tabs-images">Images</a></li>{{/images}}
                    {{/view}}
                    {{^view}}
                    {{#gateways}}<li><a href="#tabs-gateways">Gateways</a></li>{{/gateways}}
                    {{#datacollectors}}<li><a href="#tabs-datacollectors">Data Collectors</a></li>{{/datacollectors}}
                    {{#gatewaydev}}<li><a href="#tabs-gatewaydev">Devices</a></li>{{/gatewaydev}}
                    {{#devices}}<li><a href="#tabs-devices">Devices</a></li>{{/devices}}
                    {{#images}}<li><a href="#tabs-images">Images</a></li>{{/images}}
                    {{#tests}}<li><a href="#tabs-tests">Tests</a></li>{{/tests}}
                    {{#control}}<li><a href="#tabs-outputs">Device Controls</a></li>{{/control}}
                    {{#config}}<li><a href="#tabs-config">Configuration</a></li>{{/config}}
                    {{#serverconfig}}<li><a href="#tabs-serverconfig">Configuration</a></li>{{/serverconfig}}
                    {{/view}}
                </ul>
                </nav>
                {{#view}}
                <div id="tabs-view">{{{view}}}</div>
                {{#images}}<div id="tabs-images" class="content">{{{images}}}</div>{{/images}}
                {{/view}}
                {{^view}}
                {{#devices}}<div id="tabs-devices" class="content">{{{devices}}}</div>{{/devices}}
                {{#gateways}}<div id="tabs-gateways" class="content">{{{gateways}}}</div>{{/gateways}}
                {{#datacollectors}}<div id="tabs-datacollectors" class="content">{{{datacollectors}}}</div>{{/datacollectors}}
                {{#gatewaydev}}<div id="tabs-gatewaydev" class="content">{{{gatewaydev}}}</div>{{/gatewaydev}}
                {{#images}}<div id="tabs-images" class="content">{{{images}}}</div>{{/images}}
                {{#tests}}<div id="tabs-tests" class="content">{{{tests}}}</div>{{/tests}}
                {{#control}}<div id="tabs-outputs" class="content">{{{control}}}</div>{{/control}}
                {{#config}}<div id="tabs-config" class="content">{{{config}}}</div>{{/config}}
                {{#serverconfig}}<div id="tabs-serverconfig" class="content">{{{serverconfig}}}</div>{{/serverconfig}}
                {{/view}}
                <script type="text/javascript">
                    var index = $('#tabs a[href="#tabs-devices"]').parent().index();
                    var tabs = $('#tabs').tabs({
                        tabTemplate: '<li><a href="#{href}">#{label}</a></li>',
                        cookie: {
                            // store a session cookie
                            expires: 10
                        },
                        <?php
                            if (isset($_GET["DeviceID"])) {
                                print "active: index,\n";
                            }
                        ?>
                        // This updates the tables when the tab is selected
                        activate:function(e, ui) {
                            $(ui.newPanel.selector + " .tablesorter").trigger("update");
                        }
                    });
                    /* Set up the popups */
                    $(document).ready(function(){
                        $(document).tooltip();
                        HUGnetLab.UTCClock();
                    });
                </script>
            </div>
        </div>
        </section>
        <footer>
        <div class="copyright">
            <span style="float: right; padding: 5px;"><a href="http://www.hugllc.com"><img src="HUGnetLab/template/default/images/PoweredBy.png" alt="Powered by HUGnetLab&#153;" /></a></span>
            <div>&copy; Copyright 2013 <a href="http://www.hugllc.com">Hunt Utilities Group, LLC</a></div>
            <div>HUGnetLab Version {{HUGnetLabVersion}}</div>
            {{#HUGnetLibVersion}}
            <div>API Version {{HUGnetLibVersion}}</div>
            {{/HUGnetLibVersion}}
            <div>Page Generated {{pageDate}} in {{pageTime}} s</div>
        </div>
        {{#debug}}
        <div>
        <h3>Debug Information</h3>
        {{debug}}
        </div>
        {{/debug}}
        </footer>
    </body>
</html>
