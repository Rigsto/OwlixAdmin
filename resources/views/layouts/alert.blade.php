@if(session('Success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('Success')}}
    </div>
@elseif(session('Error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif(session('Fail'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('Fail')}}
    </div>
@endif
