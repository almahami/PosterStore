//Ajax, um den Akteullen anzahl der eingelogten User anzuzeigen; 
// number of active user 


/*
function lade_daten_von_server(){                   

    var httpRequest = new XMLHttpRequest();         //RequestObject erzeugen
    httpRequest.onreadystatechange = function(){
        //Reagieren au f code : 4 und status code 200
        if (this.readyState == 4 && this.status==200) {         
            console.log("ERG:" + this.responseText);
        }
    };
        
        //Methode get or post
        httpRequest.open("POST", "php/active_user.php",true);
        httpRequest.send();    

    }


    */
   setInterval(() => {
        lade_daten_von_server();
    	}, 3000);
   var httpReqObj = new XMLHttpRequest();
   function lade_daten_von_server(){

       if(httpReqObj.readyState==4){
           var serverAntwort = httpReqObj.responseText;
           var anzeigeZiel= document.getElementById("active_user");

          // if(anzeigeZiel !=null){
               anzeigeZiel.innerHTML = serverAntwort;
          // }
       } 

       httpReqObj.open("POST", "../php/active_user.php",true);
       httpReqObj.send();   
   }

   lade_daten_von_server();