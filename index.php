<?php
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <title>HUGnetLab</title>
        <link rel="stylesheet" href="templates/default/default.css" />
        <link rel="stylesheet" href="templates/jqueryui/pepper-grinder/jquery.ui.all.css" />
        <script src="includes/jquery-1.7.1.js" type="text/javascript"></script>
        <script src="includes/jquery.cookie.js" type="text/javascript"></script>
        <script src="includes/jquery.metadata.js" type="text/javascript"></script>
        <script src="includes/jquery.tablesorter.js" type="text/javascript"></script>
        <script src="includes/ui/jquery.ui.core.js" type="text/javascript"></script>
        <script src="includes/ui/jquery.ui.widget.js" type="text/javascript"></script>
        <script src="includes/ui/jquery.ui.tabs.js" type="text/javascript"></script>
        <script src="includes/ui/jquery.ui.button.js" type="text/javascript"></script>
        <script src="includes/backbone.js" type="text/javascript"></script>
        <script src="includes/mustache.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="header"><h1 class="header">HUGnetLab</h2></div>
        <div class="body">
            <?php echo $body?>
        </div>
        <div class="copyright">
            <div>&copy; Copyright 2012 <a href="http://www.hugllc.com">Hunt Utilities Group, LLC</a></div>
            <div>HUGnetLab Version <?php print HUGNETLAB_VERSION; ?></div>
            <div>Page Generated <?php print date('r'); ?> in <?php print round(microtime(true) - $pageStartTime, 4); ?> s</div>
        </div>
    </body>

<?php if ($html->args()->debug): ?>
<div>
<h3>Debug Information</h3>
<?php \HUGnet\VPrint::debug(); ?>
</div>
<?php endif; ?>

</html>

?>