@extends('frontend.layouts.front_app')
@section('content')
    <!-- =======Cookies Section Starts========== -->

    <style type="text/css">
        .main-section h3, .main-section a, .main-section h5{
            color: #e2a236 !important;
        }
        li{
            color: #ffffff;
            text-align: left;
            list-style: none;
        }
        li ol li{
            margin-bottom: 15px !important;
            line-height: 1.6;
        }
        h3{
            text-align: left;
        }
        li::before, h3::before{
            content: none !important;
        }
        .philosophy-box ol li h3{
            margin-bottom: 25px;
        }
        .main-section .teampart-header h3{
            font-weight: 700 !important;
            font-family: 'Poppins', sans-serif !important;
            text-align: center;
        }
    </style>
    <!--Philosophy Start-->
    <section id="support-sec-z" class="main-section support-section padding-bottom padding-top terms-main" style="background-color: #000000;">
        <div class="container" style="background-color: rgb(20,20,20)">
            <div class="teampart-background praivacy-background wow fadeIn" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn; background-color: transparent;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="teampart-header privacy-box pb-0 text-center">
                            <h3>Payouts</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 px-5">
                    <div class="philosophy-box cookies-box wow fadeIn" data-wow-delay=".3s" data-wow-offset="20" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
                        <ol>
                            <li>
                                <ol>
                                    <li>
                                        <p>1. When the outcome of a Game You participate in is determined or, where applicable, Propersix.casino has confirmed the relevant result of an event and settled the markets, all winnings will be available for use in Your Member Account.</p>
                                    </li>
                                    <li>
                                        <p>2. If Propersix.casino by mistake credits Your Member Account with winnings that do not belong to You, whether due to a technical or human error or otherwise, the amount will remain the property of Propersix.casino and the amount will be transferred from Your Member Account. If prior to Propersix.casino becoming aware of the mistake You have withdrawn funds that do not belong to You, without prejudice to other remedies and actions that may be available by law or otherwise, the amount paid by mistake will constitute a debt owed by You to Propersix.casino. In the event of an incorrect crediting, You are obliged to notify Propersix.casino immediately by email.</p>
                                    </li>
                                    <li>
                                        <p>3. Propersix.casino will carry out additional verification procedures for any payout exceeding the equivalent of €3000 and reserves the right to carry such verification procedures in case of lower payouts.</p>
                                    </li>
                                    <li>
                                        <p>4. Withdrawals from Your Member Account:</p>
                                    </li>
                                    <li>
                                        <p>4.1 Notice that Propersix.casino products are consumed instantly when playing. Thus, Propersix.casinocan not provide returns of goods, refunds or cancellation of Your service when playing. If You play a Game with real money, the money will be drawn from Your Member Account instantly.</p>
                                    </li>
                                    <li>
                                        <p>4.2 To free Your Member Account balance and withdraw all Your funds, You must first cancel any bets or other actions that You have made that remain outstanding.</p>
                                    </li>
                                    <li>
                                        <p>4.3 Notices for withdrawals must be made via the Website. Propersix.casino will not accept requests for withdrawal made by telephone or by electronic mail. Employees of Propersix.casino are not permitted to circumvent these instructions.</p>
                                    </li>
                                    <li>
                                        <p>4.4 Considering that You have submitted your identification documents (if applicable), Propersix.casino will process Your withdrawal request within 5 working days, wherever possible.</p>
                                    </li>
                                    <li>
                                        <p>4.5 Propersix.casino will credit Your Member Account back using the same method as You have previously deposited with, whenever possible. Upon withdrawing funds, Your own bank or other payment provider may add a further handling charge. These charges may vary over time.</p>
                                    </li>
                                    <li>
                                        <p>4.6 Propersix.casino may request identification documents for all withdrawals.</p>
                                    </li>
                                    <li>
                                        <p>4.6 Propersix.casino may request identification documents for all withdrawals.</p>
                                    </li>
                                    <li>
                                        <p>5. Minimum deposit unless otherwise stated is €10 or an equal amount in your account currency.</p>
                                   </li>
                                    <li>
                                        <p>6. All bonuses are subject to a wagering requirement of 35 times the bonus amount winnings can be withdrawn or played on other products unless otherwise stated.</p>
                                    </li>
                                    <li>
                                        <p>7. Only bets made using bonus funds will contribute towards the wagering requirement.</p>
                                    </li>
                                    <li>
                                        <p>8. Any winnings derived from bets where the wager was made up of both cash and bonus money, will be paid out in full as bonus money.</p>
                                    </li>
                                    <li>
                                        <p>9. If you request a withdrawal before meeting the wagering requirement all bonus funds will be lost.</p>
                                    </li>
                                    <li>
                                        <p>10. <a href="{{url('/')}}">Propersix.casino</a> reserves the right to change the bonus program at any time.</p>
                                    </li>
                                    <li>
                                        <p>11. <a href="{{url('/')}}">Propersix.casino</a> reserves the right to deny, revoke and/or cancel any bonuses at our discretion.</p>
                                    </li>
                                    <li>
                                        <p>12. When using bonus funds, the maximum bet allowed (until wagering requirements are met) is €5 per bet (or an equal amount in your account currency). Failure to follow this may result in forfeiting winnings.</p>
                                    </li>
                                    <li>
                                        <p>13. Unless otherwise stated in promotion-specific terms and conditions, non-funded accounts (accounts where no deposit has been made) can be used to play and win real money after completing wager requirements using free spins or bonus funds which may be issued as part of a sign-up promotion, loyalty reward or other marketing campaigns. No deposit bonus winnings refer to winnings prior to the first deposit. The player will be eligible to withdraw the no deposit bonus winnings after a deposit made but is only eligible to withdraw up to €100 worth of no deposit bonus winnings which have been accrued. If the winnings derived from a no deposit bonus exceed €100, the remaining balance of the no deposit bonus winnings will be voided. The deposited amount and any additional bonus will not be affected by the deductions. We reserve the right to request that you validate your contact details in your account when claiming no deposit bonuses.</p>
                                    </li>
                                    <li>
                                        <p>14. Risk-free bets on any games do not qualify towards wagering requirements. We reserve the right to close your account and confiscate any existing funds if evidence of bonus abuse/fraud is found.</p>
                                    </li>
                                    <li>
                                        <p>15. Our games contribute to casino bonus requirements in the following way:</p>
                                    </li>
                                    <li>
                                        <p>Slots (unless otherwise stated) - 100%</p>
                                    </li>
                                    <li>
                                        <p>Table games - 10%</p>
                                    </li>
                                    <li>
                                        <p>All other games - 0%</p>
                                    </li>
                                    <li>
                                        <p>16. All wagering on jackpot games with bonus money is prohibited and will result in immediate forfeit of all bonus money.</p>
                                    </li>
                                    <li>
                                        <p>17. If you knowingly attempt to circumvent Propersix.casino systems by using a virtual private network connection to participate in jackpots which you would otherwise not be eligible to participate in, you shall be deemed to have breached these T&Cs. Propersix.casino reserves the right to withhold all winnings or deposits made.</p>
                                    </li>
                                    <li>
                                        <p>18. All offers from Propersix.casino are meant as entertainment for the player. Propersix.casino reserves the right at any time to limit player access to offers.</p>
                                    </li>
                                    <li>
                                        <p>19. If you do not want a bonus you can contact Customer support and ask them to remove the bonus from your account.</p>
                                    </li>
                                    <li>
                                        <p>20. All bonuses bundle together i.e. if you have one bonus of €10 x35 (350 wagering) and receive another one of €20 x 40 (800 wagering), the total bonus amount is €30 and total to amount to wager will be 1150.</p>
                                    </li>
                                    <li>
                                        <p>21. There may be bonus offers which are not available in some jurisdictions, all offers available to you will show only when you are logged in to your account.</p>
                                    </li>
                                    <li>
                                        <p>22. If you attempt to manipulate the placing of bets on any games in order to expedite your deposit to vanquish your bonus funds. We reserve the right to close your account and confiscate any existing funds if evidence of bonus abuse/fraud is found.</p>
                                    </li>
                                    <li>
                                        <p>23. <a href="{{url('/')}}">Propersix.casino</a> reserves the right to change these terms at any moment without informing the player.</p>
                                    </li>
                                    <li>
                                        <p>24. General Terms and Conditions for <a href="{{url('/')}}">Propersix.casino</a> apply.</p>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Philosophy End-->


    <!--Teampart Start-->
    <section id="teampart" class="main-section parallax-window" style="background-color: #000000;">
        <div class="container" style="background-color: rgb(20,20,20)">
            <div class="teampart-background praivacy-background wow fadeIn" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn; background-color: transparent;">
                <div class="row">
                    <div class="col-lg-12 px-5">
                        <div class="teampart-header pb-0 text-center">
                            <h3>Contact Us at ProperSix!</h3>
                            <p class="pb-3">If you have questions or comments regarding the Cookies or Service,
                                please&nbsp;contact&nbsp;us&nbsp;at&nbsp;<a href="mailto:support@propersix.com">support@propersix.com</a>
                            </p>
                            <p>These contents were updated no later than [December 01, 2020].</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Teampart Start-->
    <!-- =======Cookies Section Ends========== -->
@endsection
