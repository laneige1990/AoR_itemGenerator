var formData = new FormData();
var master_stats = [];
// listen for generate button
document.getElementById("gen--submit").addEventListener("click", function (event){
    formData.delete('gen--attributes');
    event.preventDefault();
    // build object
    // item type
    formData.set("gen--type", document.getElementById("img_type2").value);
    type = document.getElementById("img_type2");
    var option= type.options[type.selectedIndex];
    formData.set("gen--type_type", option.getAttribute('it_type'));
    // item subtype    
    subtype = document.getElementById("img_type_sub2").value;
    if (subtype != "undefined" && subtype != "" && subtype != null){
        formData.set("gen--sub_type", subtype);
    }
    // level
    formData.set("gen--level", document.getElementById("gen--level").value);
    // elements & states
    var attributes = new Array;
    checkboxes = document.getElementsByClassName("gen_box")
    Array.prototype.forEach.call(checkboxes, function(element) {
        if (element.checked){
            attributes.push(element.value);
        }
    });
    // rarity
    rarity = document.getElementById("gen--rarity").value;
    formData.set("gen--rarity", rarity);
    formData.set("gen--attributes", attributes);
    // Display the key/value pairs
    sendDataAjax(formData);
});


function sendDataAjax(formData){
    var request = new XMLHttpRequest();
    request.open('POST', 'action.php?r=gen', true);
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
          if (request.status == 200) {
              var data = request.responseText;
              obj = JSON.parse(data);
              console.log(obj);
                drawData(obj);          }
        }
    };
}

function drawData(obj){
   if (obj != 0){
        master_stats = [];
        document.getElementById("fin-item_img").src = obj.img_url;
        document.getElementById("fin-item_name").innerHTML = formData.get('gen--name');
        setElements();
        setStates();
        stat_element = document.getElementById("fin-stats");
        stat_element.innerHTML = "";
        setStats(obj,formData);
           // item name
        name = document.getElementById("gen--name").value;
        formData.set("gen--name", name);
        if (name == ""){
            formData.set("gen--name", generate_name(obj));
            name_container = document.getElementById("fin-item_name");
            name_container.innerHTML = ""
            name_container.innerHTML = formData.get("gen--name");
        }
   }else{
        alert("Image does not exist for this. Add more images.");
   }  
}
 
function generate_name(obj){
    generated = "";
    generated = name_prefix();
    if (master_stats.length == 0){
        return generated;
    }
    generated = generated + " of the ";
    if (master_stats.length == 1){
        const result = obj["name"].filter(res=>res.stat_type == master_stats[0]).map(ele=>ele.name);
        generated = generated + result[0].toString();
        return generated;
    }else if(master_stats.length >= 2){
        var animal1 = obj["name"].filter(res=>res.stat_type == master_stats[0]).map(ele=>ele.name);
        animal1 = animal1[0];
        half = animal1.length / 2;
        animal1 = animal1.slice(0,half);
        var animal2 = obj["name"].filter(res=>res.stat_type == master_stats[1]).map(ele=>ele.name);
        animal2 = animal2[0];
        half = animal2.length / 2;
        animal2 = animal2.slice(half,animal2.length);
        if (master_stats.length >= 3){
            var animal3 = obj["name"].filter(res=>res.stat_type == master_stats[2]).map(ele=>ele.name);
            if (master_stats.length == 4){
                animal3 = animal3[0];
                half = animal3.length / 2;
                animal3 = animal3.slice(0,half);
                var animal4 = obj["name"].filter(res=>res.stat_type == master_stats[3]).map(ele=>ele.name);
                animal4 = animal4[0];
                half = animal4.length / 2;
                animal4 = animal4.slice(half,animal4.length);
                return generated + animal1 + animal2 + " " + animal3 + animal4;
            }
            return generated + animal1 + animal2 + " " + animal3;
        }
        return generated + animal1 + animal2;
    }
}

function name_prefix(){
    name = "";
    subtype = parseInt(formData.get("gen--sub_type"));
    type =  parseInt(formData.get("gen--type"));
            switch(type){
            case 1:
                switch(subtype){
                    case 6:
                        name = "Helm";
                    break;
                    case 7:
                        name = "Breastplate";
                    break;
                    case 8:
                        name = "Accessory";
                    break;
                }
            break;
            case 2:
                switch(subtype){
                    case 6:
                        name = "Helm";
                    break;
                    case 7:
                        name = "Hauberk";
                    break;
                    case 8:
                        name = "Accessory";
                    break;
                }
            break;
            case 3:
                switch(subtype){
                    case 6:
                        name = "Cap";
                    break;
                    case 7:
                        name = "Tunic";
                    break;
                    case 8:
                        name = "Accessory";
                    break;
                }
            break;
            case 4:
                switch(subtype){
                    case 6:
                        name = "Hat";
                    break;
                    case 7:
                        name = "Robe";
                    break;
                    case 8:
                        name = "Accessory";
                    break;
                }
            break;
            case 5:
                name = "Sheild";
            break;
            case 32:
                name = "1 Handed Sword";
            break;
            case 33:
                name = "2 Handed Sword";
            break;
            case 18:
                name = "1 Handed Axe";
            break;
            case 19:
                name = "2 Handed Axe";
            break;
            case 20:
                name = "Bow";
            break;
            case 21:
                name = "Crossbow";
            break;
            case 22:
                name = "Dagger";
            break;
            case 23:
                name = "Flail";
            break;
            case 24:
                name = "Gun";
            break;
            case 25:
                name = "1 Handed Mace";
            break;
            case 26:
                name = "2 Handed Mace";
            break;
            case 27:
                name = "Projectile";
            break;
            case 63:
                name = "Melee";
            break;
            case 28:
                name = "Scythe";
            break;
            case 29:
                name = "Spear";
            break;
            case 30:
                name = "Staff";
            break;
            case 31:
                name = "Wand";
            break;
        }
   
    return name;
}

function setStats(obj){
    var stat_count = calculateNumberStats();
    stats = {};
    for(i=0;i<stat_count;i++){
        // chose stat
        stat_chooser = Math.floor(Math.random() * 6) + 1;
        
         switch(stat_chooser){
            case 1: //HP
                stats = {statkey: "hpsp", id: "hp", title: "HP: "};   
            break;
            case 2: // SP
                stats = {statkey: "hpsp", id: "sp", title: "SP: "};
                break;
            case 3: // STR
                stats = {statkey: "stat", id: "str", title: "STR: "};
                break;
            case 4: // DEX
                stats = {statkey: "stat", id: "dex", title: "DEX: "};   
                break;
            case 5: // AGI
                stats = {statkey: "stat", id: "agi", title: "AGI: "};
                break;
            case 6: //INT
                stats = {statkey: "stat", id: "int", title: "INT: "};
                break;
        } 
        master_stats.push(stats.id);
        setStat(obj, stats);
    }
    setAtkPowDef(obj, stats);
}

function setAtkPowDef(obj){
     console.log(obj);
    var item_type = formData.get("gen--type_type");
    var patt = new RegExp("defmdef");
    if (item_type == "weapon"){
         patt = new RegExp("atkpow");
    }
    stats = [];
    obj['stats'].forEach(function(element) {
        if (patt.test(element['statkey'])){
            stats.push(element);
        }   
    });
    stat = calculationFormula(stats);
    element_container = document.getElementById("fin-atkdef");
    if (document.getElementById("fin-atkdef-atkdef") == null){
        internal_container = document.createElement("div");
        internal_container.setAttribute("id", "fin-atkdef-atkdef");
        internal_container.setAttribute("class", "w-50 d-inline-block");
        element_container.appendChild(internal_container);
    }else{
        internal_container = document.getElementById("fin-atkdef-atkdef")
        internal_container.innerHTML = "";
    }   
    var div = document.createElement('span');
    if (item_type == "weapon"){
        div.innerHTML = "ATK: " + stat;
    }else{
        var stat = getSubTypeStat(stat,  formData.get("gen--sub_type"));
        stat_chooser = Math.floor(Math.random() * 2);
        if (stat_chooser == 1){
            div.innerHTML = "MDEF: " + stat;
        }else{
            div.innerHTML = "PDEF: " + stat;
        }
        
    }
    internal_container.appendChild(div);

 
}

function getSubTypeStat(stat, subtype){
    if (subtype == "6"){ //head
        stat = stat*0.3;
    }else if(subtype == "7"){ // body
        stat = stat*0.6;
    }else{ //Accessory
        stat = stat*0.1;
    }
    return stat;
}

function setStat(obj, stats_){
    var patt = new RegExp(stats_.statkey);
    stats = [];
    obj['stats'].forEach(function(element) {
        if (patt.test(element['statkey'])){
            stats.push(element);
        }   
    });
    stat = calculationFormula(stats);
    element_container = document.getElementById("fin-stats");
    if (document.getElementById("fin-stats-"+stats_.id) == null){
        internal_container = document.createElement("div");
        internal_container.setAttribute("id", "fin-stats-"+stats_.id);
        internal_container.setAttribute("class", "w-50 d-inline-block");
        element_container.appendChild(internal_container);
    }else{
        internal_container = document.getElementById("fin-stats-"+stats_.id)
        internal_container.innerHTML = "";
    }   
    var div = document.createElement('span');
    div.innerHTML = stats_.title + stat;

    internal_container.appendChild(div);

}

function calculationFormula(stats){

    stat_rating = Math.floor(Math.random() * stats.length);
    stat_value = stats[stat_rating].statvalue;
    
    // work out raw stat number
    stat_value = stat_value.split("+");
    stat_value[0] = parseFloat(stat_value[0]);
    stat_value[1] = parseFloat(stat_value[1]);
    stat = stat_value[0] + (stat_value[1] * formData.get('gen--level'));
    // add rarity multiplier
    rarity = formData.get('gen--rarity');
    if (rarity == 58){
        stat = stat * 0.8;
        
    }else if(rarity == 59){
        stat = stat * 1;
    }else if(rarity == 60){
        stat = stat * 1.2;
    }else if(rarity == 61){
        stat = stat * 1.5;
    }else if(rarity == 62){
        stat = stat * 2.0;
    }  

    stat = stat.toFixed(0);
    return stat;

}

function calculateNumberStats(){
    level = formData.get('gen--level');
    rarity = formData.get('gen--rarity');
    if (rarity == 59){
        rarity = 10;
        no_of_possible_stats = 1;
    }else if(rarity == 60){
        rarity = 33;
        no_of_possible_stats = 2;
    }else if(rarity == 61){
        rarity = 50;
        no_of_possible_stats = 3;
    }else if(rarity == 62){
        rarity = 70;
        no_of_possible_stats = 4;
    }   
  
    value = parseFloat(level) * parseFloat(rarity);
    stat_chance = Math.sqrt(value);
    no_of_stats = 0;
        for(i=0; i < no_of_possible_stats;i++){
            rand_bool = Math.floor(Math.random() * 2) 
            rand_varient = Math.floor(Math.random() * 10) + 1 
            if (rand_bool == 0){
                stat_chance = parseFloat(stat_chance + rand_varient);
            }else{
                stat_chance = parseFloat(stat_chance - rand_varient);
            }
            stat_chance = stat_chance.toFixed(2);
            random_no = Math.floor(Math.random() * 100);
            if (random_no <= stat_chance){
                no_of_stats++;
            }
        }
    return no_of_stats;
}

function setStates(){
    //elements
    chosen_attributes = formData.getAll("gen--attributes");
    $element_container = document.getElementById("fin-states");
    $element_container.innerHTML = ""
    chosen_attributes = chosen_attributes[0].split(",");
        Array.prototype.forEach.call(obj.states, function($state) {
            var img = document.createElement('img'); 
            img.classList.add("img-fluid");
            img.classList.add("mr-2");
            if (chosen_attributes.includes("42") && $state == 42 /* death */){
                img.src = "/assets/images/death.png";
                img.setAttribute("id", "death");
            }
            if (chosen_attributes.includes("43") && $state == 43 /* stun */){
                img.src = "/assets/images/stun.png";
                img.setAttribute("id", "stun");
            }
            if (chosen_attributes.includes("45") && $state == 45 /* poison */){
                img.src = "/assets/images/poison.png";
                img.setAttribute("id", "poison");
            }
            if (chosen_attributes.includes("46") && $state == 46 /* silence */){
                img.src = "/assets/images/silence.png";
                img.setAttribute("id", "silence");
            }
            if (chosen_attributes.includes("47") && $state == 47 /* confused */){
                img.src = "/assets/images/confused.png";
                img.setAttribute("id", "confused");
            }
            if (chosen_attributes.includes("48") && $state == 48 /* sleep */){
                img.src = "/assets/images/sleep.png";
                img.setAttribute("id", "sleep");
            }
            if (chosen_attributes.includes("49") && $state == 49 /* weak */){
                img.src = "/assets/images/weak.png";
                img.setAttribute("id", "weak");
            }
            if (chosen_attributes.includes("50") && $state == 50 /* clumsy */){
                img.src = "/assets/images/clumsy.png";
                img.setAttribute("id", "clumsy");
            }
            if (chosen_attributes.includes("51") && $state == 51 /* delayed */){
                img.src = "/assets/images/delayed.png";
                img.setAttribute("id", "delayed");
            }
            if (chosen_attributes.includes("52") && $state == 52 /* enfeebled */){
                img.src = "/assets/images/enfeebled.png";
                img.setAttribute("id", "enfeebled");
            }
            if (chosen_attributes.includes("53") && $state == 53 /* sharpen */){
                img.src = "/assets/images/sharpen.png";
                img.setAttribute("id", "sharpen");
            }
            if (chosen_attributes.includes("54") && $state == 54 /* barrier */){
                img.src = "/assets/images/barrier.png";
                img.setAttribute("id", "barrier");
            }
            if (chosen_attributes.includes("55") && $state == 55 /* resist */){
                img.src = "/assets/images/resist.png";
                img.setAttribute("id", "resist");
            }
            if (chosen_attributes.includes("56") && $state == 56 /* blink */){
                img.src = "/assets/images/blink.png";
                img.setAttribute("id", "blink");
            }
            if (chosen_attributes.includes("57") && $state == 57 /* tired */){
                img.src = "/assets/images/tired.png";
                img.setAttribute("id", "tired");
            }
            if (chosen_attributes.includes("64") && $state == 64 /* steriod */){
                img.src = "/assets/images/steriod.png";
                img.setAttribute("id", "steriod");
            }
            if (chosen_attributes.includes("65") && $state == 65 /* finesse */){
                img.src = "/assets/images/finesse.png";
                img.setAttribute("id", "finesse");
            }
            if (chosen_attributes.includes("66") && $state == 66 /* swiftness */){
                img.src = "/assets/images/swiftness.png";
                img.setAttribute("id", "swiftness");
            }
            if (chosen_attributes.includes("67") && $state == 67 /* focus */){
                img.src = "/assets/images/focus.png";
                img.setAttribute("id", "focus");
            }
            if (chosen_attributes.includes("68") && $state == 68 /* blunt */){
                img.src = "/assets/images/blunt.png";
                img.setAttribute("id", "blunt");
            }
            if (chosen_attributes.includes("69") && $state == 69 /* sunder */){
                img.src = "/assets/images/sunder.png";
                img.setAttribute("id", "sunder");
            }
            if (chosen_attributes.includes("70") && $state == 70 /* succumb */){
                img.src = "/assets/images/succumb.png";
                img.setAttribute("id", "succumb");
            }
            $element_container.appendChild(img);
        });
    }

function setElements(){
//elements
$element_container = document.getElementById("fin-elements");
$element_container.innerHTML = ""
chosen_attributes = formData.getAll("gen--attributes");
chosen_attributes = chosen_attributes[0].split(",");
    Array.prototype.forEach.call(obj.elements, function($element) {
        var img = document.createElement('img'); 
        img.classList.add("img-fluid");
        img.classList.add("mr-2");
        if (chosen_attributes.includes("34") && $element == 34 /* Fire */){
            img.src = "/assets/images/fire.png";
            img.setAttribute("id", "fire");
        }
        if (chosen_attributes.includes("35") && $element == 35 /* ice */){
            img.src = "/assets/images/ice.png";
            img.setAttribute("id", "ice");
        }
        if (chosen_attributes.includes("36") && $element == 36 /* thunder */){
            img.src = "/assets/images/thunder.png";
            img.setAttribute("id", "thunder");
        }
        if (chosen_attributes.includes("38") && $element == 38 /* earth */){
            img.src = "/assets/images/earth.png";
            img.setAttribute("id", "earth");
        }
        if (chosen_attributes.includes("37") && $element == 37 /* water */){
            img.src = "/assets/images/water.png";
            img.setAttribute("id", "water");
        }
        if (chosen_attributes.includes("39") && $element == 39 /* wind */){
            img.src = "/assets/images/wind.png";
            img.setAttribute("id", "wind");
        }
        if (chosen_attributes.includes("40") && $element == 40 /* light */){
            img.src = "/assets/images/light.png";
            img.setAttribute("id", "light");
        }
        if (chosen_attributes.includes("41") && $element == 41 /* darkness */){
            img.src = "/assets/images/darkness.png";
            img.setAttribute("id", "darkness");
        }
        if (chosen_attributes.includes("71") && $element == 71 /* burst */){
            img.src = "/assets/images/burst.png";
            img.setAttribute("id", "burst");
        }
       
        if (img.hasAttribute("src")){
            
            $element_container.appendChild(img);
        }
    });

}
