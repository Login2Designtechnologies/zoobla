<?php
   $total = Session::get('total');
  $user = Auth::user();
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Registration</title>
    <meta name="description" content="Reset Password Email Template." />
    <style type="text/css">
        a:hover {
            text-decoration: underline !important;
        }
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300, 400, 500, 700|Open + Sans:300, 400, 600, 700); font-family: 'Open Sans', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width: 670px; margin: 0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height: 80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <a href="#" title="" target="_blank">
                                <img src="{{url('/public/uploads/all/cBtkPHs6RYvpyHAfupNXWTvvrfBXMHqDzvNHzsQN.png')}}" title="logo" alt="logo" style="width: 150px;" />
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="
                                        max-width: 670px;
                                        background: #fff;
                                        border-radius: 3px;
                                        text-align: center;
                                        -webkit-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                                        -moz-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                                        box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                                    ">
                                <tr>
                                    <td style="height: 40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 35px;">
                                        <img src="{{url('/public/uploads/all/payment-success.png')}}" alt="#" style="width: 21%;">
                                        <h1 style="font-size: 29px; margin-top: 0px;">Congrats..</h1>
                                        <h2 style="color: #1e1e2d; font-weight: 500; margin: -7px; font-size: 28px; font-family: 'Rubik', sans-serif;">Payment Successful</h2>
                                        <p>Name: {{$user->name}}</p>
                                        <p>Email : {{$user->email}}</p>
                                        <p>Your transaction was successful!</p>
                                        <b>Amount paid: {{$total}}</b>


                                        <span style="display: inline-block; vertical-align: middle; margin: 29px 0 26px; border-bottom: 1px solid #cecece; width: 100px;"></span>
                                        <p style="color: #000000; font-size: 15px; line-height: 24px; margin-bottom: 20px;">
                                            <!-- Dear Vendor,<br /> Greetings from CoachKaro, <br /> -->
                                        </p>

                                        <p style="color: #455056; font-size: 15px; line-height: 24px; margin-bottom: 20px;">
                                            <!-- Thanks for registering with us, click here to login to your account. Once you login to your account, it is mandatory to complete your profile, before adding buses at our portal. Please contact us in case you face any trouble in using our portal. We are
                                            here to help you.<br /> -->

                                        </p>
                                        <p style="color: #000000; font-size: 15px; line-height: 24px;">
                                            <!-- Team CoachKaro<br /> Helpline No. 888888888 <br /> Email: helpdesk@coachkaro.com -->
                                        </p>
                                        <!-- <a
                                                href="javascript:void(0);"
                                                style="
                                                    background: #29292e;
                                                    text-decoration: none !important;
                                                    font-weight: 500;
                                                    margin-top: 35px;
                                                    color: #fff;
                                                    text-transform: uppercase;
                                                    font-size: 14px;
                                                    padding: 10px 24px;
                                                    display: inline-block;
                                                    border-radius: 50px;
                                                "
                                            >
                                                Reset Password
                                            </a> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height: 40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="height: 20px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td style="height: 80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>