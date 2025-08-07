<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms', function (Blueprint $table) {
            $table->bigIncrements('site_icon');
            $table->text('site_title');
            $table->text('logo');
            $table->text('menu_text1');
            $table->text('menu_text2');
            $table->text('menu_text3');
            $table->text('menu_text4');
            $table->text('menu_text5');
            $table->text('menu_btn1');
            $table->text('menu_btn2');
            $table->text('banner_side_img');
            $table->text('banner_bg_img');
            $table->text('banner_heading');
            $table->text('banner_text');
            $table->text('banner_btn');
            $table->text('welcome_heading');
            $table->text('welcome_text');
            $table->text('welcome_btn');

            $table->text('winner_heading');
            $table->text('winner_bg');
            $table->text('winner_side_image');
            $table->text('winner_btn');
            $table->text('winner_theading1');
            $table->text('winner_theading2');
            $table->text('winner_theading3');
            $table->text('winner_tdata1');
            $table->text('winner_tdata2');
            $table->text('winner_tdata3');
            $table->text('winner_tdata4');
            $table->text('winner_tdata5');
            $table->text('winner_tdata6');
            $table->text('winner_tdata7');
            $table->text('winner_tdata8');
            $table->text('winner_tdata9');
            $table->text('winner_tdata10');
            $table->text('winner_tdata11');
            $table->text('winner_tdata12');

            //promotion section1
            $table->text('promotion_bg');
            $table->text('promotion_side_img');
            $table->text('promotion_heading1');
            $table->text('promotion_heading2');
            $table->text('promotion_text1');
            $table->text('promotion_text2');
            //promotion section2
            $table->text('promotion1_bg');
            $table->text('promotion1_icon1');
            $table->text('promotion1_icon2');
            $table->text('promotion1_icon3');
            $table->text('promotion1_icon4');
            $table->text('promotion1_icon5');
            $table->text('promotion1_heading1');
            $table->text('promotion1_heading2');
            $table->text('promotion1_text1');
            $table->text('promotion1_text2');
            //top footer
            $table->text('top_footer_bg');
            $table->text('top_footer_icon1');
            $table->text('top_footer_text1');
            $table->text('top_footer_icon2');
            $table->text('top_footer_text2');
            $table->text('top_footer_icon3');
            $table->text('top_footer_text4');
           // footer
            $table->text('footer_contact_header');
            $table->text('footer_phone_no');
            $table->text('footer_email');
            $table->text('footer_address');
            $table->text('footer_payment_header');
            $table->text('footer_payment_icon1');
            $table->text('footer_payment_icon2');
            $table->text('footer_payment_icon3');
            $table->text('footer_payment_icon4');
            $table->text('footer_fb_icon');
            $table->text('footer_tel_icon');
            $table->text('footer_twit_icon');
            $table->text('footer_linked_icon');
            $table->text('footer_promo_statement');
            //client section
            $table->text('client_img1');
            $table->text('client_img2');
            $table->text('client_img3');
            $table->text('client_img4');
            $table->text('client_img5');
            $table->text('client_promo_icon1');
            $table->text('client_promo_statement');
            //lower footer
            $table->text('subscribe_header');
            $table->text('subscribe_input_text');
            $table->text('subscribe_btn');
            $table->text('copy_right_statement');
            $table->text('footer_link1');
            $table->text('footer_link2');
            $table->text('footer_link3');
            $table->text('footer_link4');
            $table->timestamp();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms', function (Blueprint $table) {
            //
        });
    }
}
