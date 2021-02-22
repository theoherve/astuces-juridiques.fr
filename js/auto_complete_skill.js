function auto_complete_skill(){
  let input=document.getElementById('input_dropdown_skills_search').value;
  input=input.trim();
  let my_button= document.getElementById('button_submit_lawyer');
  if(input!=""){
    my_button.setAttribute("onclick","submit_lawyers()");
    my_button.setAttribute("type","button");
  } else{
    my_button.setAttribute("onclick","");
    my_button.setAttribute("type","submit");
  }
  let madiv = document.getElementById('div_dropdown_skills_res');
  madiv.style.display="flex";
    console.log(input);
    const request= new XMLHttpRequest();
    request.open('GET','search_skill.php?input='+input);
    request.onreadystatechange=function()
    {
      if(request.readyState===4)
      {
        if(request.status==200)
        {
          let myresponse=request.responseText;

          if(myresponse!=""){
            document.getElementById('div_dropdown_skills_res').innerHTML=request.responseText;
          } else{
            document.getElementById('div_dropdown_skills_res').innerHTML="0 compétences associées";
            my_button.setAttribute("onclick","wrong_skill_alert()");
            my_button.setAttribute("type","button");
            console.log(my_button);
          }

        }
      }
    }
    request.send();
}
let lancer=document.getElementById('input_dropdown_skills_search');
lancer.addEventListener("keyup",auto_complete_skill);
lancer.addEventListener("click",auto_complete_skill);



function cancel()
{
  let madiv = document.getElementById('div_dropdown_skills_res');
  if(event.target!=madiv.previousElementSibling){
    madiv.style.display="none";
}
}

function get_da_skill(param)
{
  console.log(param);
  document.getElementById('input_dropdown_skills_search').value=param;
  console.log('ok ca marche');
}
