work = () => {
    const arrive = document.getElementById("arrive").value;
    const depart = document.getElementById("depart").value;
    if(arrive > depart){
      alert('Wrong date!');
      return;
    }
    if(arrive !== '' && depart !== '')
      $(".info").load('php/search.php', {
        arrive: arrive,
        depart: depart
      });
  }
  
  book = (left, right) => {
    //const elem = document.getElementById('btn');
    //console.log(elem);
    //elem.parentNode.removeChild(elem);
    $('#btn').remove();
    $(".dop").load('php/add.php', {
      arrive: left,
      depart: right
    });
  }
  
  disable = (left, right, cnt) => {
    //console.log(left, right);
    let x = 0;
    console.log("pres"+String(cnt));
    //console.log(document.getElementById("pres"+String(cnt)));
    if(document.getElementById("pres"+String(cnt)).textContent == 'Book it!')
      x = 1,
      document.getElementById("pres"+String(cnt)).innerHTML = 'Unbook it!';
    else
      document.getElementById("pres"+String(cnt)).innerHTML = 'Book it!';
    $(".dop").load('php/status.php', {
      stan: x,
      arrive: left,
      depart: right
    })
  }
