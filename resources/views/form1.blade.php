<html>
<body>


{{ Form::open(array('url' => 'foo')) }}

        <label>First name</label><input name="first_name"><br>
        <label>Email address</label><input name="email_address"><br>
        <input type="submit">

{{ Form::close() }}

</body>
</html>
