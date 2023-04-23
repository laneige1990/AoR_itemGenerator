document.addEventListener('click', function (event) {
    if (event.target.matches('#view_load')) {
        document.querySelector("#item_data").innerHTML = '';
        getData();
    }
 }, false);

 document.addEventListener('click', function (event) {
    if (event.target.matches('.button_delete')) {
        if (confirm("Really delete this item?")) {
            deleteItem(event.target.getAttribute('value'));
        }
    }
 }, false);

 function deleteItem(id){
    document.getElementById("overlay").style.display = "block";
    var request = new XMLHttpRequest();
    request.open('POST', 'action.php?r=delete&id='+id, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
          if (request.status == 200) {
            document.getElementById(id).remove();
            document.getElementById("overlay").style.display = "none";
            }
        }
    };
 }

 function getData(){
    document.getElementById("overlay").style.display = "block";
    var request = new XMLHttpRequest();
    request.open('POST', 'action.php?r=data', true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
          if (request.status == 200) {
              var data = request.responseText;
              obj = JSON.parse(data);
     //        console.log(obj);
              drawTable(obj);   
              document.getElementById("overlay").style.display = "none";       
            }
        }
    };
 }

 function drawTable(obj){
    if (obj != 0){
        let table = document.querySelector("#item_data");
        let data = Object.keys(obj[0]);
        
        generateTableHead(table, data);
        generateTable(table, obj);
    }else{
         alert("No Data");
    }  
 }
  
  function generateTableHead(table, data) {
    let thead = table.createTHead();
    let row = thead.insertRow();
    data.push("edit/delete");
    for (let key of data) {
      let th = document.createElement("th");
      let text = document.createTextNode(key);
      th.appendChild(text);
      row.appendChild(th);
    }
  }
  
  function generateTable(table, data) {
    for (let element of data) {
      let row = table.insertRow();
      let id;
      for (key in element) {
            let cell = row.insertCell();
            let text =  document.createTextNode('undefined');
            if (key == "image_url"){
                text = img_create(element[key]);
            }else if(key == "ID"){
                id = element[key];
                row.id = id;
                text = document.createTextNode(element[key]);
            }else if(key == "rarity" || key == "type"){
                text = document.createTextNode(element[key][0]);
            }else if(key == "element"){
                text = getElements(element[key])         
            }
            else if(key == "state"){
                text = getStates(element[key])
            }
                
            if (text.length == 0){
                text = document.createTextNode("None");
            }
            if (Array.isArray(text)){
                Array.prototype.forEach.call(text, function(text_inc) {
                    cell.appendChild(text_inc);
                }); 
            }else{
                cell.appendChild(text);
            }
        }
        row.insertCell().appendChild(button_create("delete", id));

    }
}

function button_create(text, id){
    let button = document.createElement("button");
    button.innerHTML = text;
    button.value = id;
    button.className  = "button_"+text;

    return button;
}

function img_create(src, alt,/* title*/) {
    var img = document.createElement('img');
    img.src = src;
    img.style.width = "24px";
    img.style.height = "24px";
    if ( alt != null ) img.alt = alt; img.title = alt;
    return img;
}

function getStates(states){
    //elements
    let imgs = [];
    if (states.length > 0){
        Array.prototype.forEach.call(states, function(state) {
            if (state == 42 /* death */){
                img = img_create("/assets/images/death.png", "death");
                img.setAttribute("id", "death_icon");
            }
            if (state == 43 /* stun */){
                img = img_create("/assets/images/stun.png", "stun");
                img.setAttribute("id", "stun_icon");
            }
            if (state == 45 /* poison */){
                img = img_create("/assets/images/poison.png", "poison");
                img.setAttribute("id", "poison_icon");
            }
            if (state == 46 /* silence */){
                img = img_create("/assets/images/silence.png", "silence");
                img.setAttribute("id", "silence_icon");
            }
            if (state == 47 /* confused */){
                img = img_create("/assets/images/confused.png", "confused");
                img.setAttribute("id", "confused_icon");
            }
            if (state == 48 /* sleep */){
                img = img_create("/assets/images/sleep.png", "sleep");
                img.setAttribute("id", "sleep_icon");
            }
            if (state == 49 /* weak */){
                img = img_create("/assets/images/weak.png", "weak");
                img.setAttribute("id", "weak_icon");
            }
            if (state == 50 /* clumsy */){
                img = img_create("/assets/images/clumsy.png", "clumsy");
                img.setAttribute("id", "clumsy_icon");
            }
            if (state == 51 /* delayed */){
                img = img_create("/assets/images/delayed.png", "delayed");
                img.setAttribute("id", "delayed_icon");
            }
            if (state == 52 /* enfeebled */){
                img = img_create("/assets/images/enfeebled.png", "enfeebled");
                img.setAttribute("id", "enfeebled_icon");
            }
            if (state == 53 /* sharpen */){
                img = img_create("/assets/images/sharpen.png", "sharpen");
                img.setAttribute("id", "sharpen_icon");
            }
            if (state == 54 /* barrier */){
                img = img_create("/assets/images/barrier.png", "barrier");
                img.setAttribute("id", "barrier_icon");
            }
            if (state == 55 /* resist */){
                img = img_create("/assets/images/resist.png", "resist");
                img.setAttribute("id", "resist_icon");
            }
            if (state == 56 /* blink */){
                img = img_create("/assets/images/blink.png", "blink");
                img.setAttribute("id", "blink_icon");
            }
            if (state == 57 /* tired */){
                img = img_create("/assets/images/tired.png", "tired");
                img.setAttribute("id", "tired_icon");
            }
            if (state == 64 /* steriod */){
                img = img_create("/assets/images/steriod.png", "steriod");
                img.setAttribute("id", "steriod_icon");
            }
            if (state == 65 /* finesse */){
                img = img_create("/assets/images/finesse.png", "finesse");
                img.setAttribute("id", "finesse_icon");
            }
            if (state == 66 /* swiftness */){
                img = img_create("/assets/images/swiftness.png", "swiftness");
                img.setAttribute("id", "swiftness_icon");
            }
            if (state == 67 /* focus */){
                img = img_create("/assets/images/focus.png", "focus");
                img.setAttribute("id", "focus_icon");
            }
            if (state == 68 /* blunt */){
                img = img_create("/assets/images/blunt.png", "blunt");
                img.setAttribute("id", "blunt_icon");
            }
            if (state == 69 /* sunder */){
                img = img_create("/assets/images/sunder.png", "sunder");
                img.setAttribute("id", "sunder_icon");
            }
            if (state == 70 /* succumb */){
                img = img_create("/assets/images/succumb.png", "succumb");
                img.setAttribute("id", "succumb_icon");
            }
            imgs.push(img);
        });     
    }
    return imgs;
}

function getElements(elements){
//elements
let imgs = [];
    if (elements.length > 0){
       
        Array.prototype.forEach.call(elements, function(element) { 
            if (element == 34 /* Fire */){
                img = img_create("/assets/images/fire.png", "Fire");
                img.setAttribute("id", "fire_icon");
            }
            if (element == 35 /* ice */){
                img = img_create("/assets/images/ice.png", "ice");
                img.setAttribute("id", "ice_icon");
            }
            if (element == 36 /* thunder */){
                img = img_create("/assets/images/thunder.png", "thunder");
                img.setAttribute("id", "thunder_icon");
            }
            if (element == 38 /* earth */){
                img = img_create("/assets/images/earth.png", "earth");
                img.setAttribute("id", "earth_icon");
            }
            if (element == 37 /* water */){
                img = img_create("/assets/images/water.png", "water");
                img.setAttribute("id", "water_icon");
            }
            if (element == 39 /* wind */){
                img = img_create("/assets/images/wind.png", "wind");
                img.setAttribute("id", "wind_icon");
            }
            if (element == 40 /* light */){
                img = img_create("/assets/images/light.png", "light");
                img.setAttribute("id", "light_icon");
            }
            if (element == 41 /* darkness */){
                img = img_create("/assets/images/darkness.png", "darkness");
                img.setAttribute("id", "darkness_icon");
            }
            if (element == 71 /* burst */){
                img = img_create("/assets/images/burst.png", "burst");
                img.setAttribute("id", "burst_icon");
            }
            imgs.push(img);
        });     
    }
    return imgs;

}