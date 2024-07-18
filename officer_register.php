<?php include("header.php"); ?>

    <section class="px-lg-5 justify-content-center">

        <div class="container mx-0 px-0 py-5">
            <div>
                <h2 class="text-center text-success mb-2">Sign-Up</h2>
                <p class="text-center text-secondary mb-5">As an Election Officer</p>
            </div>
            <div class="row d-flex justify-content-center mb-5 px-lg-5 ">
                <div class="card items-center border-success rounded col-10 col-md-8 col-lg-6" >
                    <div class="card-body py-4">
                        <form method="" action="" class="needs-validation">
                            <div class="form-group mb-4">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your name..">
                            </div>
                            <div class="form-group mb-4">
                                <label for="phone">Phone Number</label>
                                <input type="phone" name="phone" class="form-control" id="phone" placeholder="Your phone number..">
                            </div>
                            <div class="form-group mb-4">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="officerdan@gmail.com">
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Type password..">
                            </div>
                         
                            <hr/>
                            <button type="button" class="btn btn-success btn-lg btn-block">Sign Up</button>

                        </form>
                    </div>
                </div>
                
            </div>
    </section>

<?php include("footer.php"); ?>