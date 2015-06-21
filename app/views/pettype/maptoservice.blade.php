<!DOCTYPE html>
<html>
<head>
    <title>Map Pet Type to Services Page</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<br/>
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

<h1>Map Services to Pet Type</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'pettype/storemapping')) }}

    <div class="form-group">
        {{ Form::label('pettype', 'Pet Type:') }}
        
        {{ Form::select('pettype',  $sept[0] , array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('services', 'Services:') }}
        @foreach($sept[1] as $value)            
            {{ Form::label('services', $value->serviceName ) }}
            {{ Form::checkbox('services[]', $value->id) }}
        @endforeach
    </div>

    {{ Form::submit('Create new Mapping!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>