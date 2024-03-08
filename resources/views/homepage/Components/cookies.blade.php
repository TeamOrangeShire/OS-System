<style>
    .wrapper {
  position: fixed;
  right: -370px;
  bottom: 50px;
  max-width: 345px;
  width: 100%;
  z-index: 1000;
  background: #fff;
  border-radius: 8px;
  padding: 15px 25px 22px;
  transition: all 0.3s ease;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}
.wrapper.show {
  right: 20px;
}
.title-box {
  display: flex;
  align-items: center;
  column-gap: 15px;
  color: #4070f4;
  margin-bottom: 15px;
}
.title-box i {
  font-size: 32px;
}
.title-box h3 {
  font-size: 24px;
  font-weight: 500;
}
.info {
  margin-bottom: 15px;
}
.info p {
  font-size: 16px;
  font-weight: 400;
  color: #333;
}
.info p a {
  color: #ff5c40;
  text-decoration: none;
}
.info p a:hover {
  text-decoration: underline;
}
.buttons {
  display: flex;
  gap: 7px;
  align-items: center;
  width: 100%;
}


</style>
<div class="wrapper">
    <div class="title-box">
        <i class="fa-solid fa-cookie-bite" style="color:#ff5c40"></i>
      <h3>Cookies Consent</h3>
    </div>
    <div class="info">
      <p>
        This website use cookies to help you have a superior and more relevant
        browsing experience on the website. <a href="#"> Read more...</a>
      </p>
    </div>
    <div class="buttons">
      <button class="btn btn-primary" onclick="AcceptCookie()" id="acceptBtn">Accept</button>
      <button class="btn btn-primary" onclick="DeclineCookie()" id="declineBtn">Decline</button>
    </div>
  </div>

  <script>
    // ---- ---- Const ---- ---- //
const cookiesBox = document.querySelector('.wrapper');
// ---- ---- Show ---- ---- //
const executeCodes = () => {
  cookiesBox.classList.add('show');
}
  // ---- ---- Button ---- ---- //
 function AcceptCookie(){
    const cookiesBox = document.querySelector('.wrapper');
    cookiesBox.style.display = 'none';
 }
 function DeclineCookie(){
    const cookiesBox = document.querySelector('.wrapper');
    cookiesBox.style.display = 'none';
}

window.addEventListener('load', executeCodes);

  </script>
