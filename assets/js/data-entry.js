document.addEventListener('change', function (event) {
   if (event.target.matches('#img_type')) {
      dropDownListener(event, 'img_type_sub');
   }
   else if(event.target.matches('#img_type2')){
      dropDownListener(event, 'img_type_sub2');
   }
}, false);

function dropDownListener(event, subtype){
   var it_type = event.target.options[event.target.selectedIndex].getAttribute('it_type');
      var options = document.getElementById(subtype);
      Array.prototype.forEach.call(options, function(element) {
         if (it_type == "armour"){
            if (element.text == "Head"){
               element.value = "6";
            }
            else if(element.text == "Body"){
               element.value = "7";
            }
            else if(element.text == "Accessory"){
               element.value = "8";
            }
            options.style.visibility = 'visible';
            options.style.display = 'block';

         }else{
            element.value = "";
            options.style.visibility = 'hidden';
            options.style.display = 'none';

         }
      });
}