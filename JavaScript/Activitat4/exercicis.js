// --------------
// Nou lliurament
// --------------

var lliurament = new LliuramentClass("04", "Javier Fuentes", false);

// --------------
// Exercici 1 Text color
// --------------

lliurament.add("1", function(){
	let google = document.querySelector("#goog");
	let micro = document.querySelector("#micro");
	let ubun = document.querySelector("#ubun");
	let w3 = document.querySelector("#w3");

	function styleFun(item){ item.style.background='red'; item.style.color='white'; item.style.textTransform="uppercase";}
	function styleOf(item){ item.style.background='white'; item.style.color='red'; item.style.textTransform="capitalize";}

	google.addEventListener("mouseover",function() {styleFun(google); });
	google.addEventListener("mouseout",function() {styleOf(google); });

	micro.addEventListener("mouseover",function() {styleFun(micro); });
	micro.addEventListener("mouseout",function() {styleOf(micro); });

	ubun.addEventListener("mouseover",function() {styleFun(ubun); });
	ubun.addEventListener("mouseout",function() {styleOf(ubun); });

	w3.addEventListener("mouseover",function() {styleFun(w3); });
	w3.addEventListener("mouseout",function() {styleOf(w3); });
});

// --------------
// Exercici 2 Colores tabla
// --------------

lliurament.add("2", function(){
function styleFun(item){ 
    let color = ["red","blue","green","purple","pink","brown","grey","black","yellow","orange"];
    let num = Math.floor(Math.random() * 10);
    event.target.style.background=color[num]; 
}
function styleOf(item){
    event.target.style.background='white';
}

let all = document.querySelectorAll("div");


for (i=0;i<all.length;i++)
{
    all[i].addEventListener("mouseover",function() {styleFun(all[i]); });
    all[i].addEventListener("mouseout",function() {styleOf(all[i]); });
}

});

// --------------
// Exercici 3 Contador
// --------------

lliurament.add("3", function(){
	let actualNumber = 0;

	function getNumber(number){
		let imp = number.src.split("/");
		let i = 0;
		for(i = 0; i < 10 ; i++){
			let its = (i+".png");
			if(imp[imp.length-1] == its){
				actualNumber = i;
			}
		}
		return actualNumber;
	}

	function menos(){
		let number = document.querySelector("#ex3");
		let actualNumber = getNumber(number);
		if(actualNumber == 0){
			number.src="imgPZ/9.png";

		} else {
			number.src="imgPZ/"+(actualNumber-1)+".png";
			document.querySelector("p").innerHTML = ("");
		}
	}

	function mas(){
		let number = document.querySelector("#ex3");
		let actualNumber = getNumber(number);
		if(actualNumber == 9){
			number.src="imgPZ/0.png";

		} else {
			number.src="imgPZ/"+(actualNumber+1)+".png";
			document.querySelector("p").innerHTML = ("");
		}
	}

	let masB = document.querySelector("#mas");
	let menosB = document.querySelector("#menos");
	menosB.addEventListener("click",function() {menos(); });
	masB.addEventListener("click",function() {mas(); });
});

// --------------
// Exercici 4 Plantas vs Zombies
// --------------

lliurament.add("4", function(){
	function alea(){
		let all = document.querySelectorAll("img.zomb");
		let imag = ["planta1.jpg","planta2.jpg","planta3.jpg","zombie1.jpg","zombie2.jpg","zombie3.jpg"];
		var selected = [];
		for (i=0;i<all.length;i++){
			let num = Math.floor(Math.random() * 6);
			selected.push(num);
			all[i].src="imgPZ/"+imag[num];
		}
		let totalDupes = 0;
		for(i = 0;i<imag.length;i++){
			let doubles = 0;
			for(x = 0;x<selected.length;x++){
				if(i == selected[x]){
					doubles++;
				}
			}
			if(doubles > 1){
				totalDupes += doubles-1;
			}
		}
		document.querySelector("#resultat").innerHTML = (totalDupes+" coincidencias");
	
	}
	
	let mainB = document.querySelector("#mainZ");
	mainB.addEventListener("click",function() {alea(); });	
});

// --------------
// Exercici 5 POKER
// --------------

lliurament.add("5", function(){
	var butMain = document.getElementById("main");
	var butDelete = document.getElementById("delete");
	var pokerSlot = document.getElementsByClassName("poker");

	butMain.addEventListener("click",function() {start1(); });
	butDelete.addEventListener("click",function() {restart(); });


	var N = ["01","02","03","04","05","06","07","08","09","10","11","12","13"];
	var P = ["cors","diamants","picas","trevol"];

	function start1(){
		if (butMain.value  == "Iniciar" || butMain.value  == "Continua"){
			butMain.value="Parar";
			cardSorter();
			function cardSorter(){
				setTimeout(function(){
					var cardSort = [];
					for (i=0; i< pokerSlot.length; i++){
						do {
							var rndmN = N[Math.floor(Math.random()*N.length)];
							var rndmP = P[Math.floor(Math.random()*P.length)];
							var card = rndmN + rndmP;
						}while (cardSort.includes(card));
						pokerSlot[i].src="imgPZ/poker/"+rndmN+rndmP+".png"; 
						cardSort.push(card);
					}
					if (butMain.value  == "Parar"){
						cardSorter();
					}
				}, 60);
			}
		}else {
			butMain.value="Continua";                
		}
	}

	function restart(){
		butMain.value="Iniciar";
		for (i=0;i<pokerSlot.length;i++){
			pokerSlot[i].src="imgPZ/poker/revers.png";
		}
	}
});

// --------------
// Finalitzar lliurament
// --------------
lliurament.render();