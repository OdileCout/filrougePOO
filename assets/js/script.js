//Changement de background et du texte dans la balise p
for (i = 0; i < document.getElementsByClassName('description').length; i++) {
    document.getElementsByClassName('description')[i].addEventListener('mousemove', function() {
        this.setAttribute('value', 'Acheter');
    });

    document.getElementsByClassName('description')[i].addEventListener('mouseout', function() {
        this.setAttribute('value', 'Jus de corosol');
    });
}
//Evenement qui envoie le produit dans le panier
for (i = 0; i < document.getElementsByClassName('description').length; i++) {

}
//Appel des description par API
var description = document.getElementsByClassName("desc");
window.addEventListener('', function() {
    var xhr = new XMLHttpRequest();
    for (i = 0; i < description.length; i++) {
        var choix = description[i].getAttribute("id");
        switch (choix) {
            case "description1":
                /* var name = 'red%20apple'; */
                var name = 'mangos';
                xhr.open("GET", "https://api.edamam.com/api/food-database/v2/parser?ingr=" + name + "&app_id=d471b0c8&app_key=ece14fb44109ed355c590b3eaafd62a3", true);
                xhr.send();
                xhr.onreadystatechange = function() {
                    //Je verifie le status de ma requête
                    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                        //Je parse le resultat de la requête Ajax
                        var datas = JSON.parse(xhr.responseText);
                        var datasss = datas.hints[0].food.nutrients;
                        console.log(datas);
                        var text = document.createTextNode('Nom : ' + datas.text);
                        var text2 = document.createTextNode('Catégorie : ' + datas.hints[0].food.category);
                        text3 = document.createTextNode('Calorie : ' + datasss.ENERC_KCAL + 'kcal');
                        var paragraphe = document.createElement("p");
                        var paragraphe2 = document.createElement("p");
                        var paragraphe3 = document.createElement("p");
                        paragraphe.appendChild(text);
                        paragraphe2.appendChild(text2);
                        paragraphe3.appendChild(text3);
                        document.getElementsByClassName("desc")[0].appendChild(paragraphe);
                        document.getElementsByClassName("desc")[0].appendChild(paragraphe2);
                        document.getElementsByClassName("desc")[0].appendChild(paragraphe3);
                    }
                }
                break;
            case "description2":
                /* var name = 'red%20apple'; */
                var name = 'red%20apple';
                xhr.open("GET", "https://api.edamam.com/api/food-database/v2/parser?ingr=" + name + "&app_id=d471b0c8&app_key=ece14fb44109ed355c590b3eaafd62a3", true);
                xhr.send();
                xhr.onreadystatechange = function() {
                    //Je verifie le status de ma requête
                    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                        //Je parse le resultat de la requête Ajax
                        var datas = JSON.parse(xhr.responseText);
                        var datasss = datas.hints[0].food.nutrients;
                        console.log(datas);
                        var text = document.createTextNode('Nom : ' + datas.text);
                        var text2 = document.createTextNode('Catégorie : ' + datas.hints[0].food.category);
                        text3 = document.createTextNode('Calorie : ' + datasss.ENERC_KCAL + 'kcal');
                        var paragraphe = document.createElement("p");
                        var paragraphe2 = document.createElement("p");
                        var paragraphe3 = document.createElement("p");
                        paragraphe.appendChild(text);
                        paragraphe2.appendChild(text2);
                        paragraphe3.appendChild(text3);
                        document.getElementsByClassName("desc")[1].appendChild(paragraphe);
                        document.getElementsByClassName("desc")[1].appendChild(paragraphe2);
                        document.getElementsByClassName("desc")[1].appendChild(paragraphe3);
                    }
                }
                break;
        }

    }
});
//Slider image du header
var slide = new Array("assets/img/12.jpg", "assets/img/13.jpg", "assets/img/14.jpg", "assets/img/15.jpg");
var numero = 0;
var duration = 50;
const transform = "all" + duration + "ms ease-in-out";

function ChangeSlide(sens) {
    numero = numero + sens;
    if (numero < 0)
        numero = slide.length - 1;
    if (numero > slide.length - 1)
        numero = 0;
    document.getElementById("slide").src = slide[numero];
    document.getElementById("slide").style.transition = transform;
}
setInterval("ChangeSlide(1)", 4000);
//Pour une recherche d'aliments
var bbb = document.getElementById('champ');
document.getElementById("recherche").addEventListener('click', function() {
    var xhr = new XMLHttpRequest();
    var search = bbb.value;
    xhr.open("GET", "http://api.edamam.com/auto-complete?q=" + search + "&limit=10&app_id=d471b0c8&app_key=ece14fb44109ed355c590b3eaafd62a3", true);
    xhr.send();
    xhr.onreadystatechange = function() {
        //Je verifie le status de ma requête
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            //Je parse le resultat de la requête Ajax
            var datas = JSON.parse(xhr.responseText);
            console.log(datas);
            for (i = 0; i < datas.length; i++) {
                var paragraphe = document.createElement("p");
                var text = document.createTextNode(datas[i]);
                paragraphe.appendChild(text);
                document.getElementById("afficheCherche").appendChild(paragraphe);
            }
        }
    }
});
//Appel Ajax pour la verification des formulaire d'inscription
//L'objet de l'initialisation de Ajax
/* var request = function() {
        var httpRequest = false;
        if (window.XMLHttpRequest) {
            httpRequest = new XMLHttpRequest();
            if (httpRequest.overrideMimeType) {
                httpRequest.overrideMimeType('text/xml');
                //Voir la 
            }
        } else if (window.ActiveXObject) {
            try {
                httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {

                }
            }
        }
        if (!httpRequest) {
            alert('Abandon :( Impossible de créer une instance de XMLHTTP');
            return false;
        }
        return httpRequest;
    }
    //Le traitement du formulaire d'inscription
var bouton = document.getElementById('inscription');
console.log(bouton);
var formIncsript = document.getElementById('inscript');
bouton.addEventListener('click', function() {
    //e.preventDefault();
    var data = new FormData(formIncsript);
    var xhr = request();
    xhr.open('POST', formIncsript.getAttribute('action'), true);
    xhr.send(data);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            var erros = JSON.parse(xhr.responseText);
            console.log(erros);
        }
    }
}); */