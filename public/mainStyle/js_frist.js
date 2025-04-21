let toon = document.getElementById('toon');
let kg = document.getElementById('kg');

function change($name){
    if($name == 1){

        kg.value = toon.value * (1000);
        if(toon.value==""){
            kg.value = "";
        }

    }
}

function change_2($name){
    if($name == 2){
        toon.value = kg.value / (1000);
        if(kg.value==""){
            toon.value = "";
        }
    }
}


// creat_list_user.blade.php
let form=document.getElementById('form');
function display(){
    form.classList.remove('two');
    form.classList.add('three');
}

function display_2(){
    form.classList.remove('three');
    form.classList.add('two');
}



let toon_2 = document.getElementById('toon_2');
let kg_2 = document.getElementById('kg_2');

function change($name){
    if($name == 1){
        
        kg_2.value = toon_2.value * (1000);
        if(toon_2.value==""){
                kg_2.value = "";
            }
            
        }
    }
    
    function change_2($name){
        if($name == 2){
            toon_2.value = kg_2.value / (1000);
            if(kg_2.value==""){
                toon_2.value = "";
            }
        }
    }
    
    
    
    let form_2 =document.getElementById('form_2');
    function display(){
        form.classList.remove('two');
        form.classList.add('three');
    }
    
    function display_2(){
        form.classList.remove('three');
        form.classList.add('two');
    }
    // creat_list_user.blade.php
