<p>&nbsp;</p>

<table style="background-color:black;" width="100%">
    <tr>
        <td>
            <table style="border: 0px solid #CCA300; border-collapse: collapse;" border="0" width="600" align="center" bgcolor="#00000">
                <tbody>
                    <td style="padding: 0x 0 0px 0; color: #00000;">
                        <img style="display: block;" src="https://www.propersix.casino/mail/confirm-reg/Header.png" alt="" />
                    </td>
                    <tr>
                        <td style="padding: 0px 30px 20px 40px; color: #FFFFE4; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; text-align: center; line-height: 26px;">
                        <b>Hello, {{ $username}}!</b>
                            <br />
                            <p>
                                Welcome to ProperSix!
                                <br />
                                Verify your email address by clicking on the button below:
                            </p>
                        </td>
                    </tr>
                    <td align="center">
                        <a href="{{ @$verify_url }}">
                            <img style="display: block;" src="https://www.propersix.casino/mail/confirm-reg/mid-btn.png" alt="" />
                        </a>
                        <br />
                        <p style="color: #FFFFE4;">
                            Copy the below link into browser
                                <br />
                            {{ @$verify_url }}
                         </p>
                    </td>

                    <tr>
                        <td style="padding: 20px 30px 0px 40px; color: #FFFFE4; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px; text-align: center; line-height: 26px;">
                            <p>
                                <!--If you are unable to confirm by clicking the button above, <br>
                                copy the link below into your browser: <br>
                                <a href="#" style="color: #FFFFE4; font-style: italic; text-decoration: none;">https://www.propersix.casino/casino/</a>
                                <br />-->
                                If you did not make this request, please do not confirm the registration!
                            </p>
                        </td>
                    </tr>
                    <td align="center">
                        <a href="{{ @$verify_url }}">
                            <img style="display: block;" src="https://www.propersix.casino/mail/confirm-reg/footer.png" alt="" />
                        </a>
                    </td>
                    <tr>
                        <td style="padding: 10px 30px 10px 30px;" bgcolor="#212121">
                            <table border="0">
                                <tbody>

                                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="80%">
                                        &reg; ProperSix, {{ date("Y")}}
                                        <br>
                                        <a style="color: #ffffff; font-style: italic; text-decoration: none;" href="https://www.propersix.casino/unsubscribed-newsletter/{{$user_token}}">
                                            Unsubscribe
                                        </a>
                                        from the newsletter
                                    </td>

                                    <td>
                                        <table border="0" cellspacing="4" cellpadding="0">
                                            <tbody>
                                                <tr>

                                                    <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                        <a style="color: #ffffff;" href="https://www.facebook.com/propersix/">
                                                            <img style="display: block;" src="https://www.propersix.casino/mail/confirm-reg/footfb1.png" alt="Facebook" width="30" height="30" border="0" />
                                                        </a>
                                                    </td>

                                                    <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                        <a style="color: #ffffff;" href="https://t.me/propersix1">
                                                            <img style="display: block;" src="https://www.propersix.casino/mail/confirm-reg/foottg1.png" alt="Telegram" width="30" height="30" border="0" />
                                                        </a>
                                                    </td>

                                                    <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                        <a style="color: #ffffff;" href="https://www.youtube.com/channel/UCOVCnRxBoQ_Nds3uiI0fIMg?view_as=subscriber">
                                                            <img style="display: block;" src="https://www.propersix.casino/mail/confirm-reg/footyt1.png" alt="Youtube" width="30" height="30" border="0" />
                                                        </a>
                                                    </td>

                                                    <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                        <a style="color: #ffffff;" href="https://www.instagram.com/propersix/">
                                                            <img style="display: block;" src="https://www.propersix.casino/mail/confirm-reg/footig1.png" alt="Instagram" width="30" height="30" border="0" />
                                                        </a>
                                                    </td>

                                                    <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                        <a style="color: #ffffff;" href="https://twitter.com/ProperSix">
                                                            <img style="display: block;" src="https://www.propersix.casino/mail/confirm-reg/foottw1.png" alt="Twitter" width="30" height="30" border="0" />
                                                        </a>
                                                    </td>

                                                    <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                        <a style="color: #ffffff;" href="https://www.linkedin.com/company/proper-six-prestige-network/about/?viewAsMember=true">
                                                            <img style="display: block;" src="https://www.propersix.casino/mail/confirm-reg/footli1.png" alt="LinkedIn" width="30" height="30" border="0" />
                                                        </a>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>
