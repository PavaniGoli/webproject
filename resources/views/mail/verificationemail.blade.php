Hello {{$email_data['name']}}!!
<br><br>
<b>Welcome!</b>
<br>
Please enter the below verification code and activate your account!
<br><br>
<b>{{$email_data['verification_code']}}</b>
<a href="{{ url('/verificationpage') }}">Click Here!</a>
<br><br>
Thank you!!