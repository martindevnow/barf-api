@extends('layouts.smartadmin.app')

@section('breadcrumb_left')
    <i class="fa-fw fa fa-home"></i> Dashboard <span>> Payments</span>
@endsection

@section('breadcrumb_right')

    <ul id="sparks" class="">
        <li class="sparks-info">
            <a href="/admin/deliveries/create">
                <button class="btn btn-block btn-primary">
                    <i class="fa fa-wrench"></i> Create New
                </button>
            </a>
        </li>
    </ul>

@endsection

@section('content')

    <div class="jarviswidget  jarviswidget-sortable jarviswidget-color-blue" id="wid-id-1" data-widget-editbutton="false" role="widget" data-widget-attstyle="jarviswidget-color-blue">
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
        <header role="heading">
            <div class="jarviswidget-ctrls" role="menu">
                <a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Collapse"><i class="fa fa-minus "></i></a>
                <a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a>
                <a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Delete"><i class="fa fa-times"></i></a>
            </div>
            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
            <h2> Deliveries </h2>
            <span class="jarviswidget-loader" style="display: none;"><i class="fa fa-refresh fa-spin"></i></span></header>

        <!-- widget div-->
        <div role="content">

            <!-- widget content -->
            <div class="widget-body">

                {{--<div class="alert alert-info no-margin fade in">--}}
                {{--<button class="close" data-dismiss="alert">--}}
                {{--×--}}
                {{--</button>--}}
                {{--<i class="fa-fw fa fa-info"></i>--}}
                {{--Adds zebra-striping to table row within <code>&lt;table&gt;</code> by adding the <code>.table-striped</code> with the base class--}}
                {{--</div>--}}

                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <td>Date Shipped</td>
                            <td>Date Received</td>
                            <td>Recipient</td>
                            <td>Order Number</td>
                            <td>Courier</td>
                            <td>Tracking Number</td>
                            <td>Delivery Instructions</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <a href="/admin/deliveries/{{ $delivery->id }}">
                                    {{ $delivery->shipped_at->format('Y-m-d') }}
                                </a>
                            </td>
                            <td>{{ $delivery->delivered() ? $delivery->delivered_at->format('Y-m-d') : '' }}</td>
                            <td>{{ $delivery->recipient->name }}</td>
                            <td>{{ $delivery->order->id }}</td>
                            <td>{{ $delivery->courier->label }}</td>
                            <td>{{ $delivery->tracking_number }}</td>
                            <td>{{ $delivery->instructions }}</td>
                            <td>
                                <a href="/admin/deliveries/{{ $delivery->id }}/edit">
                                    <button class="btn btn-primary btn-xs">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </a>

                                <form action="/admin/deliveries/{{ $delivery->id }}" method="POST">
                                    <?= csrf_field() ?>
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input name="delivery_id" type="hidden" value="{{ $delivery->id }}">
                                    <button class="btn btn-xs btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>

@endsection