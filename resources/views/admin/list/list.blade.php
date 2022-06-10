@extends('layouts.app')

@section('content')
<div class="container">  
    <div class="nav-tabs-custom">
        @include('admin.'.$module.'.header')
        <div class="tab-content">
            <div class="tab-pane active">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::model($singleData, array('files' => true, 'autocomplete' => 'off')) !!}
                        {!!csrf_field()!!}
                        <div class="box-header">
                            <h3 class="box-title">
                                @if($singleData->id) Edit List ID: {{$singleData->id}} @else  Add New List @endif
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                {!! Form::label("List Name") !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter List name']) !!}
                                <em class="error-msg">{!!$errors->first('name')!!}</em>
                            </div>
                        </div>
                        <div></div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="col-md-6">
                        <div class="box-header">
                            <h3 class="box-title">List of To-Do Lists</h3>
                            <small class="pull-right">
                            <a href="{{URL::to('items/list')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Lists</a>
                            </small>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>List Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 0; ?>
                                        @foreach ($allData as $row)
                                        <?php $count++; ?>
                                        <tr class="@if($row->status==0) disabledBg @endif">
                                            <td>{{$count}}</td>
                                            <td>{!!$row->name!!}</td>
                                        
                                            <td>
                                                <a href="{{ URL::to('items/list/'.$row->id.'/edit')}}" class="btn btn-sm btn-warning">Edit</a>
                                                <a href="{{ URL::to('items/list/'.$row->id.'/delete')}}" onclick="if(!confirm('Are you sure to delete this data?')){return false;}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection