<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Orange Shire - Sign up </title>
      <link rel="icon" href="img/os_logo.png">
      <link rel="stylesheet" href="css/login.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="container">
         <header>Sign Up for<br> Orange Shire</header>
         <div class="progress-bar">
            <div class="step">
               <p>
                  Name
               </p>
               <div class="bullet">
                  <span>1</span>
               </div>
               <div class="check fas fa-check"></div>
            </div>
            <div class="step">
               <p>
               Addtional  
               </p>
               <div class="bullet">
                  <span>2</span>
               </div>
               <div class="check fas fa-check"></div>
            </div>
            <div class="step">
               <p>
                  Contact
               </p>
               <div class="bullet">
                  <span>3</span>
               </div>
               <div class="check fas fa-check"></div>
            </div>
            <div class="step">
               <p>
                  Submit
               </p>
               <div class="bullet">
                  <span>4</span>
               </div>
               <div class="check fas fa-check"></div>
            </div>
         </div>
         <div class="form-outer">
            <form action="#">
               <div class="page slide-page">
                  <div class="title">
                     Name Info:
                  </div>
                  <div class="field">
                     <div class="label">
                        First Name
                     </div>
                     <input type="text" placeholder="ex. John">
                  </div>
                  <div class="field">
                     <div class="label">
                        Last Name
                     </div>
                     <input type="text" placeholder="ex. Doe">
                  </div>
                  <div class="field">
                     <button type="button" class="firstNext next">Next</button>
                  </div>
               </div>
               <div class="page">
               <div class="title">
                  Additional Name Info:
                  </div>
                  <div class="field">
                     <div class="label">
                        Middle Name
                     </div>
                     <input type="text" placeholder="ex. Doe">
                  </div>
                  <div class="field">
                     <div class="label">
                        Extension
                     </div>
                     <select>
                        <option selected>None</option>
                        <option>Jr.</option>
                        <option>Sr.</option>
                        <option>I</option>
                        <option>II</option>
                        <option>III</option>
                        <option>IV</option>
                        <option>V</option>
                     </select>
                  </div>
                  <div class="field btns">
                     <button class="prev-1 prev">Previous</button>
                     <button class="next-1 next">Next</button>
                  </div>
               </div>
               <div class="page">
               <div class="title">
                     Contact Info:
                  </div>
                  <div class="field">
                     <div class="label">
                        Email Address
                     </div>
                     <input type="text" placeholder="yourname@gmail.com">
                  </div>
                  <div class="field">
                     <div class="label">
                        Phone Number
                     </div>
                     <input type="Number" placeholder="+344343">
                  </div>
                  <div class="field btns">
                     <button class="prev-2 prev">Previous</button>
                     <button class="next-2 next">Next</button>
                  </div>
               </div>
               <div class="page">
                  <div class="title">
                     Login Details:
                  </div>
                  <div class="field">
                     <div class="label">
                        Username
                     </div>
                     <input type="text" placeholder="john1">
                  </div>
                  <div class="field">
                     <div class="label">
                        Password
                     </div>
                     <input type="password" placeholder="#123AaBbCc">
                  </div>
                  <div class="field btns">
                     <button class="prev-3 prev">Previous</button>
                     <button class="submit">Submit</button>
                  </div>
               </div>
               
            </form>
            <div class="sign-txt">Already a member? <a style="color: #ff5c40" href="{{ route('customer_login') }}">Login Now</a></div>
         </div>
      </div>
      <script src="js/login.js"></script>
   </body>
</html>