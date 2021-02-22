function haveYouForget(){

  console.log('ok');

  let contract = document.getElementById('contract');
  let monday = document.getElementById('monday').checked;
  let monday_1 = document.getElementById('monday_1').value;
  let monday_2 = document.getElementById('monday_2').value;
  let tuesday = document.getElementById('tuesday').checked;
  let tuesday_1 = document.getElementById('tuesday_1').value;
  let tuesday_2 = document.getElementById('tuesday_2').value;
  let wednesday = document.getElementById('wednesday').checked;
  let wednesday_1 = document.getElementById('wednesday_1').value;
  let wednesday_2 = document.getElementById('wednesday_2').value;
  let thursday = document.getElementById('thursday').checked;
  let thursday_1 = document.getElementById('thursday_1').value;
  let thursday_2 = document.getElementById('thursday_2').value;
  let friday = document.getElementById('friday').checked;
  let friday_1 = document.getElementById('friday_1').value;
  let friday_2 = document.getElementById('friday_2').value;
  let buttonValider = document.getElementById('validButton');
  // buttonValider.disabled = true;
  // while (contract.checked === false) {  }
  // let verif = setInterval(isOk() , 1000);
  let mond = 0;
  let tues = 0;
  let wedn = 0;
  let thur = 0;
  let frid = 0;
  let week = 0;



// function isOk(){
// buttonValider.disabled = true;
    mond = setInterval(isMonday(monday, monday_1, monday_2){},3000);
    tues = setInterval(isTuesday(tuesday, tuesday_1, tuesday_2){},3000);
    wedn = setInterval(isWednesday(wednesday, wednesday_1, wednesday_2){},3000);
    thur = setInterval(isThursday(thursday, thursday_1, thursday_2){},3000);
    frid = setInterval(isFriday(friday, friday_1, friday_2){},3000);
    week = setInterval(isAllRight(mond, tues, wedn, thur, frid){},3000);




    if(week == 0) {
      // buttonValider.disabled = true;
      console.log("Veuillez cocher un jour de la semaine.");

    if(contract == false) {
      buttonValider.disabled = true;
      console.log("Veuillez accepter les termes et conditions.");
      }

    if(week == 1 && ontract == true){
      console.log("Le formulaire a été envoyé.");
    }





  console.log(week);
  console.log(mond);
  console.log(tues);
  console.log(wedn);
  console.log(thur);
  console.log(frid);
}

function isAllRight(mond, tues, wedn, thur, frid){
  if(mond == 1 && tues == 1 && wedn == 1 && thur == 1 && frid == 1){
    buttonValider.disabled = false;
    return 1;
  }else {
    buttonValider.disabled = true;
    return 0;
  }
}

function isMonday(monday, monday_1, monday_2){
  if( ( (monday_1.length != 0 || monday_2.length != 0) && monday == true)
  || ((monday_1.length == 0 && monday_2.length == 0) && monday == false) ){
    return 1;
  }else{
    return 0;
  }
}

function isTuesday(tuesday, tuesday_1, tuesday_2){
  if(((tuesday_1.length != 0 || tuesday_2.length != 0) && tuesday == true) ||
  ((tuesday_1.length == 0 && tuesday_2.length == 0) && tuesday == false)){
    return 1;
  }else{
    return 0;
  }
}

function isWednesday(wednesday, wednesday_1, wednesday_2){
  if(((wednesday_1.length != 0 || wednesday_2.length != 0) && wednesday == true) ||
  ((wednesday_1.length == 0 && wednesday_2.length == 0) && wednesday == false)){
    return 1;
  }else{
    return 0;
  }
}

function isThursday(thursday, thursday_1, thursday_2){
  if(((thursday_1.length != 0 || thursday_2.length != 0) && thursday == true) ||
  ((thursday_1.length == 0 && thursday_2.length == 0) && thursday == false)){
    return 1;
  }else{
    return 0;
  }
}

function isFriday(friday, friday_1, friday_2){
  if(((friday_1.length != 0 || friday_2.length != 0) && friday == true) ||
  ((friday_1.length == 0 && friday_2.length == 0) && friday == false)){
    return 1;
  }else{
    return 0;
  }
}
