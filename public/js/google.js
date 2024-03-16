
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-app.js";

  import { getAuth, GoogleAuthProvider,signInWithPopup, signOut } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-auth.js";

  const firebaseConfig = {
    apiKey: "AIzaSyDhl726allSmziDcKaUpJw-xj4Oob90Or0",
    authDomain: "orange-shire-c8a67.firebaseapp.com",
    projectId: "orange-shire-c8a67",
    storageBucket: "orange-shire-c8a67.appspot.com",
    messagingSenderId: "806223828802",
    appId: "1:806223828802:web:d048fe81c690c84d459adb",
    measurementId: "G-ZGZNH6GKVR"
  };

  const app = initializeApp(firebaseConfig);
  const auth = getAuth(app);
  auth.languageCode = 'it';
  const provider = new GoogleAuthProvider();

  const btn = document.getElementById('google-btn');

  btn.addEventListener("click", function(){
    signInWithPopup(auth, provider)
    .then((result) => {
        const user = result.user;
        const displayName = user.displayName;
        const nameArray = displayName.split(" ");

        let firstName = "";
        let middleName = "";
        let lastName = "";

        if (nameArray.length > 0) {
            firstName = nameArray[0];
            
            if (nameArray.length === 2) {
                lastName = nameArray[1];
            } else if (nameArray.length > 2) {
                lastName = nameArray[nameArray.length - 1];
                middleName = nameArray.slice(1, nameArray.length - 1).join(" ");
            }
        }

        console.log("First Name:", firstName);
        console.log("Middle Name:", middleName);
        console.log("Last Name:", lastName);

        alert('Login');
    }).catch((error) => {
        const errorCode = error.code;
        const errorMessage = error.message;
        // Handle error
    });
});

  const logout = document.getElementById('logout');

  logout.addEventListener("click", function(){
    signOut(auth)
    .then(() => {
        alert('Logout successful');
    }).catch((error) => {
        // Handle error
    });
  });