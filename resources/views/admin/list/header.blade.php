@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
@if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
@if(count($errors) > 0)<div class="alert alert-danger"><strong>Whoops!</strong> There were some problems with your input.</div>@endif

<ul class="nav nav-tabs">
    <li @if(Request::is('*'.$module.'s')) class="active" @endif><a href="{{URL::to('items')}}"><i class="fa fa-list"></i> <span>Manage</span></a></li> ||
    <li @if(Request::is('*category*')) class="active" @endif><a href="{{URL::to('items/list')}}"><i class="fa fa-cubes"></i> <span>Lists</span></a></li> ||
    <li @if(Request::is('*add')) class="active" @endif><a href="{{URL::to('item/add')}}"><i class="fa fa-plus"></i> <span>Add</span></a></li>
    @yield('actions')
  
</ul>