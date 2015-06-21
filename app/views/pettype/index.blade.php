<!DOCTYPE html>
<html>
<head>
    <title>Pet Types Page</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="navbar navbar-default navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <li{{ (Request::is('admin') ? ' class="active"' : '') }}><a href="{{{ URL::to('admin') }}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                        
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="{{{ URL::to('/') }}}">View Homepage</a></li>
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <span class="glyphicon glyphicon-user"></span> Admin <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{{ URL::to('user/settings') }}}"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{{ URL::to('user/logout') }}}"><span class="glyphicon glyphicon-share"></span> Logout</a></li>
                                </ul>
                        </li>
                    </ul>
                </div>
            </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <a class="navbar-brand" href="{{ URL::to('service') }}">Service Alert</a>
    
<ul class="nav navbar-nav">
            <li><a href="{{ URL::to('service') }}">View All Services</a></li>
        <li><a href="{{ URL::to('service/create') }}">Create a Service</a></li>
        <li><a href="{{ URL::to('pettype') }}">View All Pet Types</a></li>
        <li><a href="{{ URL::to('pettype/create') }}">Add new Pet Type</a></li>
        <li><a href="{{ URL::to('pettype/viewall') }}">View all mappings</a></li>
        <li><a href="{{ URL::to('pettype/maptoservice') }}">Add Pet type Mapping With Service(s)</a></li>
    
    </ul>
        </div>
</div>
<div style="height:100px;"></div>
<br/>
<h1>All the Pet Types</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Pet Type</td>            
            <td>Status</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($pettype as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->pettype }}</td>
            @if($value->status == 1)
                <td>Active</td>
            @else
                <td>Inactive</td>
            @endif    
            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->
                {{ Form::open(array('url' => 'pettype/' . $value->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete Pet Type', array('class' => 'btn btn-warning')) }}
                {{ Form::close() }}

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('pettype/' . $value->id) }}">Show Pet Type</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('pettype/' . $value->id . '/edit') }}">Edit Pet Type</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
<!-- Javascripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/wysihtml5/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('assets/js/wysihtml5/bootstrap-wysihtml5.js')}}"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/js/datatables-bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/datatables.fnReloadAjax.js')}}"></script>
    <script src="{{asset('assets/js/jquery.colorbox.js')}}"></script>
    <script src="{{asset('assets/js/prettify.js')}}"></script>

    <script type="text/javascript">
        $('.wysihtml5').wysihtml5();
        $(prettyPrint);
    </script>
</body>
</html>
