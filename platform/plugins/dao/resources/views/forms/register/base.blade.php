@extends('core/acl::auth.master')

@section('content')
<div class="container">
    @if ($showStart)
    {!! Form::open(Arr::except($formOptions, ['template'])) !!}
    @endif

    @php do_action(BASE_ACTION_TOP_FORM_CONTENT_NOTIFICATION, request(), $form->getModel()) @endphp
    <div class="row">
        <div class="col-12">
            @if ($showFields && $form->hasMainFields())
            <div class="main-form">
                <div class="{{ $form->getWrapperClass() }}">
                    @foreach ($fields as $key => $field)
                    @unset($fields[$key])
                    @if (!in_array($field->getName(), $exclude))
                    {!! $field->render() !!}
                    @endif
                    @endforeach
                    <div class="clearfix"></div>
                </div>
                {!! $form->getActionButtons() !!}
            </div>
        </div>
        @endif
    </div>
    @if ($showEnd)
    {!! Form::close() !!}
    @endif
</div>
@stop

@push('footer')
{!! $form->renderValidatorJs() !!}
@endpush