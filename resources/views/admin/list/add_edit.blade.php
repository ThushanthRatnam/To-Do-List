@extends('layouts.app')

@section('actions')
    @if($singleData->id)
    <li @if(Request::is('*edit')) class="active" @endif><a href="{{URL::to('item/'.$singleData->id.'/edit')}}"><i class="fa fa-edit"></i> <span>Edit</span></a></li>
    <li @if(Request::is('*view')) class="active" @endif><a href="{{URL::to('item/'.$singleData->id.'/view')}}"><i class="fa fa-search-plus"></i> <span>View</span></a></li>
    @endif
@endsection

@section('content')
<div class="container">  
    <div class="nav-tabs-custom">
        @include('admin.'.$module.'.header')
        <div class="tab-content">
            <div class="tab-pane active">
                {!!Form::model($singleData, array('files' => true, 'autocomplete' => 'off'))!!}
                {!!csrf_field()!!}
                <div class="row">
                    <div class="col-8">
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                {!!Form::label("Title *")!!}
                                {!!Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Item title'])!!}
                                <em class="error-msg">{!!$errors->first('title')!!}</em>
                            </div>
                            <div class="form-group {{ $errors->has('list_id') ? 'has-error' : '' }}">
                                {!!Form::label("To-Do List *")!!}
                                {!!Form::select('list_id', $itemlist, null, ['class' => 'form-control', 'placeholder'=>'Select a List'])!!}
                                <em class="error-msg">{!!$errors->first('list_id')!!}</em>
                                <span class="pull-right"><a href="{{url('items/list')}}" target="_blank">Add List</a></span>
                            </div>
                            <div class="form-group {{ $errors->has('due_date') ? 'has-error' : '' }}">
                                {!!Form::label("Due-Date")!!}
                                {!!Form::date('due_date', null, ['class' => 'form-control', 'placeholder'=>'Select Due-Date '])!!}
                                <em class="error-msg">{!!$errors->first('due_date')!!}</em>
                            </div>
                        </div>
            
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
@endsection