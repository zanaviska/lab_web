function myFunction() {
  console.log(document.getElementById("email").value.indexOf("@"));
  //alert(document.getElementById("name").value);
  const fname = document.getElementById("name").value;
  const mail = document.getElementById("email").value;
  const at = mail.indexOf("@");
  const phone = document.getElementById("phone").value;
  let submitOK = "true";
  //console.log(1);
  if (fname.length === 0) {
    alert("You should enter your name");
    submitOK = "false";
  } else if (fname[0] !== fname[0].toUpperCase()) {
    alert("There is no such name");
    submitOK = "false";
  } else if (isNaN(phone) || phone[0] !== '0' || phone.length !== 10) {
    alert("Incorrect phone");
    submitOK = "false";
  } else if (at === -1 || at === 0 || at === mail.length-1) {
    alert("Not a valid e-mail!");
    submitOK = "false";
  }
  
  if (submitOK === "false") {
    return false;
  }
}

function myMove() {
  let elem = document.getElementsByClassName("big")[0];  
  console.log(elem.parentElement); 
  //console.log(elem.offsetLeft, elem.offsetTop); 
  let oy = 50;
  let ox = 50;
  let x = 1;
  let y = 1;
  const id = setInterval(frame, 5);
  function frame() {
    //clearInterval(id);
    if (ox <= 15) x = 1, clearInterval(id);
    if (ox >= elem.parentElement.offsetHeight - 81) x = -1;
    if (oy <= 5) y = 1;
    if (oy >= elem.parentElement.offsetWidth - 100) y = -1;
    ox += x;
    oy += y; 
    elem.style.top = ox + "px"; 
    elem.style.left = oy + "px";
  }
}