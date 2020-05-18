@extends('core/base::layouts.master')
@section('content')
    <div class="table-wrapper">
        @if ($table->isHasFilter())
            <div class="table-configuration-wrap" style="display: block;">
                <span class="configuration-close-btn btn-show-table-options"><i class="fa fa-times"></i></span>
                {!! $table->renderFilter() !!}
            </div>
        @endif
        <div class="portlet light bordered portlet-no-padding">
            <div class="portlet-title">
                <div class="caption">
                    <div class="wrapper-action">
                        @if ($actions)
                            <div class="btn-group">
                                <a class="btn btn-secondary dropdown-toggle" href="#" data-toggle="dropdown">{{ trans('core/table::general.bulk_actions') }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($actions as $action)
                                        <li>
                                            {!! $action !!}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($table->isHasFilter())
                            <button class="btn btn-primary btn-show-table-options">{{ trans('core/table::general.filters') }}</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive @if ($actions) table-has-actions @endif @if ($table->isHasFilter()) table-has-filter @endif">
                    @section('main-table')
                        {!! $dataTable->table(compact('id', 'class'), false) !!}
                    @show
                </div>
            </div>
        </div>
    </div>
    @include('core/table::modal')
@stop
@section('javascript')
    {!! $dataTable->scripts() !!}
@stop