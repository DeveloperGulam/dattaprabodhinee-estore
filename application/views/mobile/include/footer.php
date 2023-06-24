        <!--====================  footer area ====================-->
        <footer>
            <div class="footer-nav-wrapper">
                <a href="<?php echo base_url();?>" class="footer-nav-single">
                    <div class="menu-wrapper">
                        <img src="<?php echo base_url('assets/mobile/img/icons/home.svg'); ?>" class="injectable" alt="">
                        <span>Home</span>
                    </div>
                </a>
                <a href="<?php echo base_url('categories/');?>" class="footer-nav-single">
                    <div class="menu-wrapper">
                        <i class="fa fa-list" aria-hidden="true" style="font-size:20px;"></i>
                        <span>Category</span>
                    </div>
                </a>
                <a href="<?php echo base_url('cart/');?>" class="footer-nav-single">
                    <div class="menu-wrapper">
                        <?php if($this->cart->total_items()!==0){ ?>
                        <span class="badge text-danger" style="font-size:18px;"><?php echo $this->cart->total_items(); ?></span>
                        <?php } ?>
                        <img src="<?php echo base_url('assets/mobile/img/icons/cart.svg'); ?>" class="injectable" alt="">
                        <span>Cart</span>
                    </div>
                </a>
                <a href="<?php echo base_url('profile/');?>" class="footer-nav-single">
                    <div class="menu-wrapper">
                        <img src="<?php echo base_url('assets/mobile/img/icons/profile.svg');?>" class="injectable" alt="">
                        <span>Profile</span>
                    </div>
                </a>
            </div>
        </footer>
        <!--====================  End of footer area  ====================-->
    </div>
    <!-- JS
    ============================================ -->
    <!-- Modernizer JS -->
    <script src="<?php echo base_url('assets/mobile/js/modernizr-2.8.3.min.js'); ?>"></script>
    <!-- jQuery JS -->
    <script src="<?php echo base_url('assets/mobile/js/jquery-3.5.1.min.js'); ?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?php echo base_url('assets/mobile/js/bootstrap.min.js'); ?>"></script>

    <!-- Plugins JS (Please remove the comment from below plugins.min.js for better website load performance and remove plugin js files from above) -->

    <script src="<?php echo base_url('assets/mobile/js/plugins/plugins.min.js'); ?>"></script>

    <!-- Main JS -->
    <script src="<?php echo base_url('assets/mobile/js/main.js'); ?>"></script>
</body>
</html>