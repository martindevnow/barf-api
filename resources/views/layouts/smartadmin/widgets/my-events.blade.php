<!-- new widget -->
<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-colorbutton="false">

    <!-- widget options:
    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

    data-widget-colorbutton="false"
    data-widget-editbutton="false"
    data-widget-togglebutton="false"
    data-widget-deletebutton="false"
    data-widget-fullscreenbutton="false"
    data-widget-custombutton="false"
    data-widget-collapsed="true"
    data-widget-sortable="false"

    -->
    <header>
        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
        <h2> My Events </h2>
        <div class="widget-toolbar">
            <!-- add: non-hidden - to disable auto hide -->
            <div class="btn-group">
                <button class="btn dropdown-toggle btn-xs btn-default" data-toggle="dropdown">
                    Showing <i class="fa fa-caret-down"></i>
                </button>
                <ul class="dropdown-menu js-status-update pull-right">
                    <li>
                        <a href="javascript:void(0);" id="mt">Month</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" id="ag">Agenda</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" id="td">Today</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- widget div-->
    <div>
        <!-- widget edit box -->
        <div class="jarviswidget-editbox">

            <input class="form-control" type="text">

        </div>
        <!-- end widget edit box -->

        <div class="widget-body no-padding">
            <!-- content goes here -->
            <div class="widget-body-toolbar">

                <div id="calendar-buttons">

                    <div class="btn-group">
                        <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-prev"><i class="fa fa-chevron-left"></i></a>
                        <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-next"><i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div id="calendar"></div>

            <!-- end content -->
        </div>

    </div>
    <!-- end widget div -->
</div>
<!-- end widget -->