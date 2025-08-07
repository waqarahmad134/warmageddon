<!DOCTYPE html>
<html>
<head>
    <title>ProperSix Casino</title>
</head>

<body>
<h2>Welcome to ProperSix Casino Mr./Mrs. {{$user['name']}}</h2>
<br/>
Your registered email is {{$user['email']}} , Please click on the below link to verify your email account
<br/>
<a href="{{url('user/verify', $user->verifyUser->token)}}">Verify Email</a>
</body>

</html>