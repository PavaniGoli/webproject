Hello {{$email_data['name']}} !!

Please Click the below link to change your password
<br><br>
<a href="{{ url('setnewpassword/'.$email_data['email']) }}">Click Here!</a>

<br><br>
Thank you!!