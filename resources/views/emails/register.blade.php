<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Taxi Private Limited</title>
</head>
<body bgcolor="#0f3462" style="margin-top:20px;margin-bottom:20px">
<!-- Main table -->
<table border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="white" width="650" style="
    background: #efefef;
    padding: 30px;
">
    <tr>
        <td>
            <!-- Child table -->
            <table border="0" cellspacing="0" cellpadding="0" style="color:#0f3462; font-family: sans-serif;">
                <tr></tr>
                <tr>
                    <td style="text-align: center;">
                        <h1 style="margin: 0px;padding-bottom: 25px; text-transform: uppercase;">Hi {{$mailData['name']}}, your Registration Success!</h1>
                        <h2 style="margin: 0px;padding-bottom: 25px;font-size:22px;"> You have successfully registered with City taxi Private limited!</h2>
                        <p style=" margin: 0px 40px;padding-bottom: 25px;line-height: 2; font-size: 15px;">
                            Please use below credentials to login next time.
                        </p>
                        <p style=" margin: 0px 32px;padding-bottom: 25px;line-height: 2; font-size: 15px;">
                            <strong>Username</strong>: {{$mailData['user_name']}}<br />
                            <strong>Password</strong>: {{$mailData['password']}}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="$sda" style="background-color:#36b445; color:white; padding:15px 97px; max-width: 300px; text-align: center; outline: none; display: block; margin: auto; border-radius: 31px;
                                font-weight: bold; margin-top: 25px; margin-bottom: 25px; border: none; text-transform:uppercase; ">Dashboard</a>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <h2 style="padding-top: 25px; line-height: 1; margin:0px;">Need Help? or not You?</h2>
                        <div style="margin-bottom: 25px; font-size: 15px;margin-top:7px;"><a href="">Contact Us</a>
                        </div>
                    </td>
                </tr>
            </table>
            <!-- /Child table -->
        </td>
    </tr>
</table>
<!-- / Main table -->
</body>

</html>
