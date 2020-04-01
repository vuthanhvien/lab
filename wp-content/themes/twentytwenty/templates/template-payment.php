<?php
/**
 * Template Name: Payment Template
 * Template Post Type: page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */


$user = wp_get_current_user();

$options = Array();

$options['trial_standard_1_month'] = get_option('trial_standard_1_month');
$options['trial_premium_1_month'] = get_option('trial_premium_1_month');
$options['premium_1_month'] = get_option('premium_1_month');
$options['standard_1_month'] = get_option('standard_1_month');
$options['standard_1_year'] = get_option('standard_1_year');
$options['premium_1_year'] = get_option('premium_1_year');


get_header();

?>

<main id="site-content" role="main">
<div class="section-inner" >
<div class="profile">
<div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">VNPAY DEMO</h3>
            </div>
            <h3>Tạo mới đơn hàng</h3>
            <div class="table-responsive">
                <form action="/vnpay.php" id="create_form" method="post">       

                    <div class="form-group">
                        <label for="language">Loại hàng hóa </label>
                        <select name="order_type" id="order_type" class="form-control">
                            <?php 
                            foreach ($options as $option=>$key ) {
                                echo '<option value="'.$option.'">'.$option.'($'.$key.'.00)</option>';
                            }
                            ?>
                        </select>
                    </div>
                 <button type="submit" class="btn btn-default">Thanh toán Redirect</button>

                </form>
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                <p>&copy; VNPAY 2015</p>
            </footer>
        </div>  

        <script type="text/javascript">

        console.log(window.vnpay);
            $("#btnPopup").click(function () {
                var postData = $("#create_form").serialize();
                var submitUrl = $("#create_form").attr("action");
                $.ajax({
                    type: "POST",
                    url: submitUrl,
                    data: postData,
                    dataType: 'JSON',
                    success: function (x) {
                        console.log(x);
                        if (x.code === '00') {
                            if (window.vnpay) {
                                vnpay.open({width: 768, height: 600, url: x.data});
                            } else {
                                location.href = x.data;
                            }
                            return false;
                        } else {
                            alert(x.Message);
                        }
                    }
                });
                return false;
            });
        </script>

<p class="auth-redirect">

</p>
</div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
