@extends('layouts.app')

@section('content')
<div class="container">
    <div class="nav-tabs-custom">    
    @include('admin.'.$module.'.header')
    @if(count($IncompletedData)>0)
    <div>
        <h3>Incompleted Tasks</h3>
    </div>
    <div class="tab-content">
        <div class="tab-pane active">
            <div class="box-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>To-Do-List Name</th>
                                <th>Due Date</th>
                                <th>User</th>
                                <th>Active Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <?php $count = 0; ?>
                            @foreach ($IncompletedData as $row)
                            <?php $count++; ?>
                            <tr class="">
                                <td>{{$count}}</td>
                              
                                <td><a href="{{ URL::to('item/'.$row->id.'/view')}}">{!!$row->title!!}</a></td>
                                <td>
                                    <input type="hidden"  id="item" name="item'" value="{{$row->id}} "/>
                                    @if($row->list_id){!!$row->item_list->name!!}@endif</td>
                                <td>{{$row->due_date}}</td>
                                <td>@if($row->user_id){!!$row->user->first_name!!}@endif</td>
                                <td>
                                    @if($row->status == 0)
                                    <input type="hidden"  id="status" name="status'" onclick="update_status()" value="{{$row->status}} "/>
                                    <input type="button" class="btn btn-danger btn-sm" onclick="update_status()" value="Incompleted"/>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{URL::to('item/'.$row->id.'/view')}}" class="btn btn-sm btn-success"> view</a>
                                    <a href="{{URL::to('item/'.$row->id.'/edit')}}" class="btn btn-sm btn-warning"> Edit </a>
                                    <a href="{{URL::to('item/'.$row->id.'/delete')}}" class="btn btn-sm btn-danger"> Delete </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!!$IncompletedData->links()!!}
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(count($completedData)>0)
    <div>
        <h3>Completed Tasks</h3>
    </div>
    <div class="tab-content">
        <div class="tab-pane active">
            <div class="box-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>To-Do-List Name</th>
                                <th>Due Date</th>
                                <th>User</th>
                                <th>Active Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                            <?php $count = 0; ?>
                            @foreach ($completedData as $row)
                            <?php $count++; ?>
                            <tr class="">
                                <td>{{$count}}</td>
                              
                                <td><a href="{{ URL::to('item/'.$row->id.'/view')}}">{!!$row->title!!}</a></td>
                                <td>
                                    <input type="hidden"  id="item" name="item'" value="{{$row->id}} "/>
                                    @if($row->list_id){!!$row->item_list->name!!}@endif</td>
                                <td>{{$row->due_date}}</td>
                                <td>@if($row->user_id){!!$row->user->first_name!!}@endif</td>
                                <td>
                                   <input type="button" class="btn btn-success btn-sm" value="completed"/>
                                </td>
                                <td>
                                    <a href="{{URL::to('item/'.$row->id.'/view')}}" class="btn btn-sm btn-success"> view</a>
                                    <a href="{{URL::to('item/'.$row->id.'/edit')}}" class="btn btn-sm btn-warning"> Edit </a>
                                    <a href="{{URL::to('item/'.$row->id.'/delete')}}" class="btn btn-sm btn-danger"> Delete </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!!$completedData->links()!!}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
</div>
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

    function update_status() {
        var item_id = $('#item').val();
        var status = $('#status').val();
        var content = '';

        status= 1-status;
        if (status == 1 ) {
            $('#status').val(0);
            content = 'enable';
        } else if(status == 0) {
            $('#status').val(1);
            content = 'disable';
        }
        console.log(item_id,status);
        $.ajax({
            url: '/api/statusUpdate',
            type: "GET",
            url: "{{ url('/item/status') }}",
            data: {
                item_id: item_id,
                status: status,
                "_token": "{{ csrf_token() }}"
            },     
            success:function(data) {
                var res = data;
                location.reload();
            }
        });
    }

</script>