<style>
.btn{
	background:#f55d2c;
	color:white;
}
</style>
<!--====================  profile header ====================-->
        <div class="profile-header-area space-pt--30 space-mb--40">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="profile-header">
                            <div class="profile-header__image">
                                <img src="<?php if($user_details->customer_img==''){
									echo base_url('assets/images/avatar/img-5.jpg');
								}
								else{
									if($user_details->login_oauth_uid==''){
									    echo base_url('assets/images/avatar/'.$user_details->customer_img);
								    }
								    else
								    {
								        echo $user_details->customer_img;
								    }
								}?>" class="img-fluid" alt="">
                            </div>
                            <div class="profile-header__content space-mt--10">
                                <h3 class="name space-mb--15"><?php echo $user_details->name; ?></h3>
                                <div class="profile-info space-mb--10">
                                    <div class="profile-info-block">
                                        <div class="profile-info-block__value">
                                            <?php echo $user_details->number; ?>
                                        </div>
                                        <div class="profile-info-block__title">
                                            Mobile Number
                                        </div>
                                    </div>
                                    <div class="profile-info-block">
                                        <div class="profile-info-block__title">
                                            <a href="<?php echo base_url('edit-profile/');?>" class="btn btn-sm">Edit Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of profile header  ====================-->
        <!--====================  profile body ====================-->
        <div class="profile-body-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="profile-body">
                            <div class="profile-info-table space-mb--40">
                                <div class="profile-info-block">
                                    <div class="profile-info-block__title">Full Name</div>
                                    <div class="profile-info-block__value"><?php echo $user_details->name; ?></div>
                                </div>
                                <!--<div class="profile-info-block">
                                    <div class="profile-info-block__title">User Name</div>
                                    <div class="profile-info-block__value">john007</div>
                                </div>-->
                                <div class="profile-info-block">
                                    <div class="profile-info-block__title">Phone</div>
                                    <div class="profile-info-block__value">(+91) <?php echo $user_details->number; ?></div>
                                </div>
                                <div class="profile-info-block">
                                    <div class="profile-info-block__title">E-mail</div>
                                    <div class="profile-info-block__value"><?php echo $user_details->email; ?></div>
                                </div>
								<div class="profile-info-block">
                                    <div class="profile-info-block__title">City</div>
                                    <div class="profile-info-block__value"><?php echo $user_details->city; ?></div>
                                </div>
								<div class="profile-info-block">
                                    <div class="profile-info-block__title">State</div>
                                    <div class="profile-info-block__value"><?php echo $user_details->state; ?></div>
                                </div>
								<div class="profile-info-block">
                                    <div class="profile-info-block__title">Zipcode</div>
                                    <div class="profile-info-block__value"><?php echo $user_details->zipcode; ?></div>
                                </div>
                                <div class="profile-info-block">
                                    <div class="profile-info-block__title">Shipping Address</div>
                                    <div class="profile-info-block__value"><?php echo $user_details->address; ?>
                                    </div>
                                </div>
                                <!--<div class="profile-info-block">
                                    <div class="profile-info-block__title">Total Order</div>
                                    <div class="profile-info-block__value">25</div>
                                </div>
                                <div class="profile-info-block">
                                    <div class="profile-info-block__title">Edit Profile</div>
                                    <div class="profile-info-block__value"><a href="edit-profile.html"><img
                                                src="assets/img/icons/edit.svg" class="injectable" alt=""></a></div>
                                </div>
                            </div>
                            <div class="profile-info-table">
                                <div class="profile-info-block">
                                    <div class="profile-info-block__title">Help Center</div>
                                    <div class="profile-info-block__value">62256</div>
                                </div>
                                <div class="profile-info-block">
                                    <div class="profile-info-block__title">To be Shiped</div>
                                    <div class="profile-info-block__value">05</div>
                                </div>
                                <div class="profile-info-block">
                                    <div class="profile-info-block__title">Review</div>
                                    <div class="profile-info-block__value">10</div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of profile body  ====================-->