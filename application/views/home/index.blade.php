@layout('layouts.layout')

@section('main-content')
    <div class="home">
        <h2>Login</h2>
        {{ Form::open('api/v1/authenticate','post') }}
        <p>
            {{ Form::label('email','Email:') }}<br>
            {{ Form::input('text','email','',array('id'=>'email')) }}
        </p>

        <p>
            {{ Form::label('password','Password:') }}<br>
            {{ Form::password('password',array('id'=>'password')) }}
        </p>

        <p>
            {{ Form::submit('Login') }} | {{ HTML::link_to_route('signup','Signup') }}
        </p>

        {{ Form::close() }}
    </div>
@endsection