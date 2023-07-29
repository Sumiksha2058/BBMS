

<form action="includes/recipient-form.php" class="row needs-validation" novalidate autocomplete="off">
 
       
            <!-- Recipient Form Section -->

            <div class="form-section g-5" id="recipient">
                <div class="col md-6">
                    <label for="recipientName" class="form-label">Full Name</label>
                    <input type="text" name="recp_name" class="form-control" id="recipientName" placeholder="Enter your full name">
                </div>
                <div class="col md-6">
                    <label  class="form-label">Gender</label>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" value="Male" name="recp_gender" id="gender" >
                    <label class="form-check-label"  for="gender">
                        Male
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" value="Female" name="recp_gender" id="flexRadioDisabled" >
                    <label class="form-check-label" for="flexRadioDisabled">
                        Female
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" value="Other" name="recp_gender" id="flexRadioDisabled">
                    <label class="form-check-label" for="flexRadioDisabled">
                        Other
                    </label>
                    </div>
                </div>
               
                <div class="col md-6">
                    <label for="recipientAge" class="form-label fs-auto ">Age</label>
                    <input type="number" class="form-control" name="recp_age" id="recipientAge" placeholder="Enter Your Age" required>
                </div>
                <div class="col md-6">
                    <label for="recipientEmail" class="form-label">Email</label>
                    <input type="email" name="recp_email" class="form-control" id="recipientEmail" placeholder="Enter your email">
                </div>
                <div class="col md-6">
                    <label for="recipientContact" class="form-label">Contact</label>
                    <input type="text" name="recp_contact" class="form-control" id="recipientContact" placeholder="Enter your contact number">
                </div>
                <div class="col md-6">
                    <label for="recipientBloodGroup" class="form-label">Required Blood Group</label>
                    <select class="form-select" name="recp_reqblood" id="recipientBloodGroup">
                        <option class="w-75" selected >Select required blood group</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
                <div class="col md-6">
                    <label for="medicalReport" class="form-label fs-auto ">Medical Report (optional)</label>
                    <input type="file" name="recp_medicalReport" class="form-control"  id="medicalReport" required>
                </div>
                  <div class="col md-6">
                    <label for="RecipientPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="recp_password" id="RecipientPassword" placeholder="Password">
                  </div>

                  <div class="col md-6">
                    <label for="RecipientConformPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="recp_cpassword" id="RecipientConformPassword" placeholder="Re-enter Password">
                  </div>

                  
                  

                  <div class="col md-6 text-center mb-3 ">
                    <span>Already registered <a href="login.php">Login Here</a></span>
                  </div>


                  <div class="col md-6 float-end">
                   
                    <button type="cancel"  class="btn btn-primary">Register</button>
                    <button type="submit" name="recp_register" class="btn btn-primary">Cancel</button>
                  </div>
            </div>
        </div>
  
           
        </form>