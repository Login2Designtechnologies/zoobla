<?php
  $product = Session::get('productdetail');
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Wishlist</title>
        <meta name="description" content="Reset Password Email Template." />
        <style type="text/css">
            a:hover {
                text-decoration: underline !important;
            }
        </style>
    </head>

    <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
        <!--100% body table-->
        <table
            cellspacing="0"
            border="0"
            cellpadding="0"
            width="100%"
            bgcolor="#f2f3f8"
            style="@import url(https://fonts.googleapis.com/css?family=Rubik:300, 400, 500, 700|Open + Sans:300, 400, 600, 700); font-family: 'Open Sans', sans-serif;"
        >
            <tr>
                <td>
                    <table style="background-color: #f2f3f8; max-width: 670px; margin: 0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="height: 80px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <a href="" title="logo" target="_blank">
                                    <img src="{{url('/public/uploads/all/cBtkPHs6RYvpyHAfupNXWTvvrfBXMHqDzvNHzsQN.png')}}" title="logo" alt="logo" style="width: 150px;height: 70px;" />
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 20px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table
                                    width="95%"
                                    border="0"
                                    align="center"
                                    cellpadding="0"
                                    cellspacing="0"
                                    style="
                                        max-width: 670px;
                                        background: #fff;
                                        border-radius: 3px;
                                        text-align: center;
                                        -webkit-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                                        -moz-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                                        box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                                    "
                                >
                                    <tr>
                                        <td style="height: 40px;">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0 35px;">
                                            <h1 style="color: #1e1e2d; font-weight: 500; margin: 0; font-size: 32px; font-family: 'Rubik', sans-serif;">Wishlist</h1>
                                            <span style="display: inline-block; vertical-align: middle; margin: 29px 0 26px; border-bottom: 1px solid #cecece; width: 100px;"></span>
                                            <p style="color: #000000; font-size: 15px; line-height: 24px; margin-bottom: 20px;">
                                                Dear Customer,<br />

                                                Greetings from Zoobla, <br />
                                            </p>
                                            <p style="color: #455056; font-size: 15px; line-height: 24px; margin-bottom: 20px;">
                                                Just wanted to let you know that your wishlist request has been received and the product is successfully added to your wishlist.<br />
                                                <ul style="list-style-type: none;">
                                                    <li style="color: #455056;">Product name: <span style="color: #2bacd1">{{$product->name}}</span></li>
                                                    <li style="color: #455056;">Product Unit Price: <span style="color: #2bacd1">{{$product->unit_price}}</span></li>
                                                </ul>
                                               
                                            </p>
                                            <p style="color: #000000; font-size: 15px; line-height: 24px;">
                                                Team Zoobla<br />
                                               
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
