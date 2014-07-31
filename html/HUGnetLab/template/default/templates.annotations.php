<!--  These are our tempaltes -->
        <script type="text/template" id="AnnotationPropertiesTitleTemplate">
            Annotation for <%= test %>:<%= testcol %>
        </script>
        <script type="text/template" id="AnnotationPropertiesTemplate">
                <form id="annotationForm" method="POST" action="javascript:void(0);">
                <table style="width:100%;">
                    <tr class="even"><th class="right">ID</th><td><% print(test.toString(16)) %>:<%= testcol %> on <%= sqlUTCDate(testdate * 1000) %></td></tr>
                    <tr class="odd">
                        <th class="right">Your Name</th>
                        <td><input type="text" name="author" value="<%= author %>"/></td>
                    </tr>
                    <tr class="even">
                        <th class="right">Title</th>
                        <td><input type="text" name="title" value="<%= title %>"/></td>
                    </tr>
                    <tr class="odd">
                        <th class="right">Text</th>
                        <td><textarea type="text" name="text"><%= text %></textarea></td>
                    </tr>
                    <tr class="even">
                        <th class="right">&nbsp;</th>
                        <td>
                            <button name="save" class="save">Save</button>
                        </td>
                    </tr>
                </table>
                </form>
        </script>
        <script type="text/template" id="AnnotationsTemplate">
                <div>
                </div>
                <div style="clear:both;">
                <table id="annotationTable" class="tablesorter {sortlist: [[2,0]]}">
                    <thead>
                    <tr>
                        <th class="sorter-numeric" width="5%">id</th>
                        <th class="sorter-text">Author</th>
                        <th class="sorter-text">Title</th>
                    </tr>
                    </thead>
                    <tbody id="AnnotationList">
                    </tbody>
                </table>
                </div>
        </script>
        <script type="text/template" id="AnnotationEntryTemplate">
                        <td class="center"><%= id %></td>
                        <td><%= author %></td>
                        <td><%= title %></td>
                    </tr>
                    <tr>
                        <td colspan="3"><%= text %></td>
        </script>


