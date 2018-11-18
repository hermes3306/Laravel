<html>
<body>

{{ Form::open(array('url' => '/foo', 'method' => 'post')) }}


		{{ Form::label('First name') }}  
		{{ Form::text('first_name', 'Jason Park') }}  <br>

		{{ Form::label('Email address') }} 
		{{ Form::text('email_address', 'jason.park@hotmail.com') }}  <br>

		{{ Form::label('Age address') }} 
		{{ Form::selectRange('age', 20, 100) }} <br>

		{{ Form::submit('Submit') }} <br>

{{ Form::close() }}

</body>
</html>
