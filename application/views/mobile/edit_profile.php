<!--====================  breadcrumb area ====================-->
        <div class="breadcrumb-area bg-color--grey space-y--15">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-3">
                        <a href="<?php echo base_url('profile/');?>" class="back-link"> <i class="fa fa-angle-left"></i> Back</a>
                    </div>
                    <div class="col-6">
                        <h1 class="page-title text-center">Edit Profile</h1>
                    </div>
                </div>
            </div>
        </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.16.4"></script>
<script>
$(document).ready(function(){

(function() {
var placesAutocomplete = places({
appId: 'plEHFE8OXN3L',
apiKey: 'a6eb12d44e181f3c3c3d02bd7cf7b2fd',
container: document.querySelector('#city')
});

var $address = document.querySelector('#address-value')
placesAutocomplete.on('change', function(e) {
$address.textContent = e.suggestion.value
});

placesAutocomplete.on('clear', function() {
$address.textContent = 'none';
});

})();


});
</script>

        <script>
            function validationCheck()
            {
                var phoneNo=document.getElementById('phoneNo').value;
                if(phoneNo.length==10)
                {
                    document.getElementById('errno').innerText="";
                    return true;
                }
                else
                {
                    //alert("message");
                    document.getElementById('errno').innerText="Please Insert Valid Mobile Number";
                    return false;
                }
            }
            function validationCheck2()
            {
                var pincode=document.getElementById('zipcode').value;
                if(pincode.length==6)
                {
                    document.getElementById('errpin').innerText="";
                    return true;
                }
                else
                {
                    document.getElementById('errpin').innerText="Please Insert Valid Pincode";
                    return false;
                }
            }
        </script>
        <!--====================  End of breadcrumb area  ====================-->
        <!--====================  edit profile body ====================-->
        <div class="edit-profile-body space-mt--30">
            <div class="container">
                <div class="row">
                    <div class="col-12">
						<?php if($this->session->flashdata('msg')){ ?>
							<div class="alert alert-success" role="alert">
							  <?php echo $this->session->flashdata('msg'); ?>
							</div>
							<?php } ?>
							<?php if($this->session->flashdata('err')){ ?>
							<div class="alert alert-danger" role="alert">
							  <?php echo $this->session->flashdata('err'); ?>
							</div>
							<?php } ?>
                        <!-- edit profile form -->
                        <div class="edit-profile-form">
                            <form action="<?php echo base_url('Welcome_controller/update_profile/'.$logged_user->id);?>" method="post">
                                <div class="edit-profile-form__single-field space-mb--30">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" value="<?php echo $logged_user->name; ?>" required name="name" id="fullName" placeholder="Enter Full Name">
                                </div>
                                <div class="edit-profile-form__single-field space-mb--30">
                                    <label for="phoneNo">Phone</label>
                                    <input onmouseout="validationCheck()" type="number" pattern="\d{3}[\-]\d{3}[\-]\d{4}" required value="<?php echo $logged_user->number; ?>" name="number" id="phoneNo" placeholder="Enter Phone Number">
                                    <p class="text-danger font-weight-bold" id="errno"></p>
                                </div>
                                <div class="edit-profile-form__single-field space-mb--30">
                                    <label for="emailAddress">Email Address</label>
                                    <input type="email" name="email" required value="<?php echo $logged_user->email; ?>" id="emailAddress"
                                        placeholder="Enter Email Address">
                                </div>
                                <div class="edit-profile-form__single-field space-mb--30">
                                    <label for="city">City</label>
                                    <input type="text" name="city" required value="<?php echo $logged_user->city; ?>" id="city"
                                        placeholder="Enter Your City">
                                </div>
                                <div class="edit-profile-form__single-field space-mb--30">
                                    <label for="state">State</label>
                                    <input type="text" name="state" required value="<?php echo $logged_user->state; ?>" id="state"
                                        placeholder="Enter Your State">
                                </div>
                                <div class="edit-profile-form__single-field space-mb--30">
                                    <label for="zipcode">Pincode</label>
                                    <input onmouseout="validationCheck2()" type="number" pattern="\d{3}[\-]\d{3}[\-]\d{4}" name="pincode" required value="<?php echo $logged_user->zipcode; ?>" id="zipcode"
                                        placeholder="Enter Your Pincode">
                                        <p class="text-danger font-weight-bold" id="errpin"></p>
                                </div>
                                <div class="edit-profile-form__single-field space-mb--30">
                                    <label for="shippingAddress">Shipping Address</label>
                                    <textarea name="address" id="shippingAddress" cols="30" required rows="5" placeholder="Enter Shipping Address"><?php echo $logged_user->address; ?></textarea>
                                </div>
                                <button class="edit-profile-form__button">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====================  End of edit profile body  ====================-->