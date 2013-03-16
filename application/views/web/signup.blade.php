@layout('layouts.layout')

@section('main-content')
<div class="home">
    <h2>Signup</h2>
    {{ Form::open('api/v1/user','post') }}

    <p>
        {{ Form::label('surname','Surname:') }}<br>
        {{ Form::input('text','surname','',array('id'=>'surname')) }}
    </p>

    <p>
        {{ Form::label('firstname','First Name:') }}<br>
        {{ Form::input('text','firstname','',array('id'=>'firstname')) }}
    </p>

    <p>
        {{ Form::label('password','Password:') }}<br>
        {{ Form::password('password',array('id'=>'password')) }}
    </p>


    <p>
        {{ Form::label('email','Email:') }}<br>
        {{ Form::input('text','email','',array('id'=>'email')) }}
    </p>

    <p>
        {{ Form::label('gsm','GSM:') }}<br>
        {{ Form::input('text','gsm','',array('id'=>'gsm','maxlength'=>11)) }}
    </p>

    <p>
        {{ Form::label('state','State:') }}<br>
        {{ Util::state_dropdown('state','',array('id'=>'state')) }}
    </p>

    <p>
        {{ Form::label('lga','Local Government:') }}<br>
        <span id="auto_select">{{ Util::lga_dropdown('lga',1,array('id'=>'lga')) }}</span>

    </p>

    <p>
        {{ Form::submit('Signup') }} | {{ HTML::link_to_route('home','Cancel') }}
    </p>

    {{ Form::close() }}
</div>
@endsection