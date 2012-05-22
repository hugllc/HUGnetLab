<!--
/**
 * Main index
 *
 * <pre>
 * CoreUI is a user interface for the HUGnet cores.
 * Copyright (C) 2007 Hunt Utilities Group, LLC
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * </pre>
 *
 * @category   UI
 * @package    CoreUI
 * @subpackage Main
 * @author     Scott Price <prices@hugllc.com>
 * @copyright  2007 Hunt Utilities Group, LLC
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    SVN: $Id$
 * @link       https://dev.hugllc.com/index.php/Project:HUGnetLib
 */
-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>HUGnetLab on {{host}}</title>
        <link rel="stylesheet" href="HUGnetLab/template/default/default.css" />
        <link rel="stylesheet" href="HUGnetLab/template/default/jquery.jqplot.css" />
        <link rel="stylesheet" href="HUGnetLab/template/default/pepper-grinder/jquery-ui.css" />
        <script src="/HUGnetLib/contrib.js" type="text/javascript"></script>
        <script src="/HUGnetLib/hugnet.js" type="text/javascript"></script>
        <script src="HUGnetLab/template/default/hugnetlab.js" type="text/javascript"></script>
        {{header}}
    </head>
    <body>
        <header>
        <div id="header"><h1 class="header">HUGnetLab</h1></div>
        </header>
        <section>
        <div class="body">
            <div id="tabs">
                <nav>
                <ul>
                    <li><a href="#tabs-tests">Tests</a></li>
                    <li><a href="#tabs-config">Configuration</a></li>
                </ul>
                </nav>
                <div id="tabs-tests">
                </div>
                <div id="tabs-config">
                </div>
            </div>
        </div>
        </section>
        <footer>
        <div class="copyright">
            <div>&copy; Copyright 2012 <a href="http://www.hugllc.com">Hunt Utilities Group, LLC</a></div>
            <div>HUGnetLab Version {{HUGnetLabVersion}}</div>
            <div>Page Generated {{pageDate}} in {{pageTime}} s</div>
        </div>
        {{#debug}}
        <div>
        <h3>Debug Information</h3>
        {{debug}}
        </div>
        {{/debug}}
        </footer>
        <?php require dirname(__FILE__)."/templates.devices.php"; ?>
        <?php require dirname(__FILE__)."/templates.data.php"; ?>
        <?php require dirname(__FILE__)."/templates.tests.php"; ?>
    </body>
</html>
