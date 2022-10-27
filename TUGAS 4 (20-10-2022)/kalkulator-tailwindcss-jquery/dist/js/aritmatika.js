// Insert angka
function insert(num){
	document.form.textarea.value = document.form.textarea.value + num;
}

// Fungsi Hitung
function equal(){
	var hasil = document.form.textarea.value;
	document.form.textarea.value = eval(hasil);
}

// Fungsi Clean atau Bersihkan Text
function clean(){
	document.form.textarea.value = "";
}