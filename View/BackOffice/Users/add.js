function verif_cin(){
    var req = document.getElementById('cin');
    req.setAttribute('required', true);
    var st = document.getElementById('cin').value;
    var cin = /^[0-9]+$/;
    if(st.length!=8){
    document.getElementById("cin").style.borderColor = "red";
    document.getElementById("err_cin").style.color = "red";
    document.getElementById("err_cin").innerHTML = "CIN must be of 8 numbers";
    }
    else if(!st.match(cin)){
    document.getElementById("cin").style.borderColor = "red";
    document.getElementById("err_cin").style.color = "red";
    document.getElementById("err_cin").innerHTML = "CIN must respect the format(exemple:12345678)";
    }
    else{
    document.getElementById("cin").style.borderColor = "green";
    document.getElementById("err_cin").style.color = "green";
    document.getElementById("err_cin").innerHTML = "Correct";
    return true;
    }
    return false;
}
function verif_nom(){
    var req = document.getElementById('nom');
    req.setAttribute('required', true);
    var st = document.getElementById("nom").value;
    var lettre = /^[a-zA-Z]+$/;
    if(st.length<1){
    document.getElementById("nom").style.borderColor = "red";
    document.getElementById("err_nom").style.color = "red";
    document.getElementById("err_nom").innerHTML = "Last name must contain more than one character";
    }
    else if(!st.match(lettre)){
    document.getElementById("nom").style.borderColor = "red";
    document.getElementById("err_nom").style.color = "red";
    document.getElementById("err_nom").innerHTML = "Last name must contain only characters(letters only)";
    }
    else{
    document.getElementById("nom").style.borderColor = "green";
    document.getElementById("err_nom").style.color = "green";
    document.getElementById("err_nom").innerHTML = "Correct";
    return true;
    }
    return false;
}
function verif_prenom(){
    var req = document.getElementById('prenom');
    req.setAttribute('required', true);
    var st = document.getElementById('prenom').value;
    var lettre = /^[A-Za-z]+$/;
    if(st.length<1){
    document.getElementById("prenom").style.borderColor = "red";
    document.getElementById("err_prenom").style.color = "red";
    document.getElementById("err_prenom").innerHTML = "First name must contain more than one character";
    }
    else if(!st.match(lettre)){
    document.getElementById("prenom").style.borderColor = "red";
    document.getElementById("err_prenom").style.color = "red";
    document.getElementById("err_prenom").innerHTML = "First name must contain only characters(letters only)";
    }
    else{
    document.getElementById("prenom").style.borderColor = "green";
    document.getElementById("err_prenom").style.color = "green";
    document.getElementById("err_prenom").innerHTML = "Correct";
    return true;
    }
    return false;
}
function verif_datenaissance(){
    var req = document.getElementById('date_naissance');
    req.setAttribute('required', true);
    var dateInput=new Date(document.getElementById("date_naissance").value);
    var sysDate=new Date();
    if(dateInput<sysDate){
    document.getElementById("date_naissance").style.borderColor = "green";
    document.getElementById("err_date").style.color = "green";
    document.getElementById("err_date").innerHTML = "Correct";
    return true;
    }
    else{
    document.getElementById("date_naissance").style.borderColor = "red";
    document.getElementById("err_date").style.color = "red";
    document.getElementById("err_date").innerHTML = "Il faut saisir une date inferieure a la date d'aujourdhui!!";
    }
    return false;
}
function verif_email(){
    var req = document.getElementById('email');
    req.setAttribute('required', true);
    var st = document.getElementById('email').value;
    var formule = /^[\w.-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/;
    if(st.length<1){
    document.getElementById("email").style.borderColor = "red";
    document.getElementById("err_email").style.color = "red";
    document.getElementById("err_email").innerHTML = "Email must contain more than one character";
    }
    else if(!st.match(formule)){
    document.getElementById("email").style.borderColor = "red";
    document.getElementById("err_email").style.color = "red";
    document.getElementById("err_email").innerHTML = "Email must respect the format(user@exemple.tn)";
    }
    else{
    document.getElementById("email").style.borderColor = "green";
    document.getElementById("err_email").style.color = "green";
    document.getElementById("err_email").innerHTML = "Correct";
    return true;
    }
    return false;
}
function verif_numtel(){
    var req = document.getElementById('tel');
    req.setAttribute('required', true);
    var st = document.getElementById('tel').value;
    var tel = /^[0-9]+$/;
    if(st.length!=8){
    document.getElementById("tel").style.borderColor = "red";
    document.getElementById("err_tel").style.color = "red";
    document.getElementById("err_tel").innerHTML = "Tel must be of 8 numbers";
    }
    else if(!st.match(tel)){
    document.getElementById("tel").style.borderColor = "red";
    document.getElementById("err_tel").style.color = "red";
    document.getElementById("err_tel").innerHTML = "Tel must respect the format(exemple:12345678)";
    }
    else{
    document.getElementById("tel").style.borderColor = "green";
    document.getElementById("err_tel").style.color = "green";
    document.getElementById("err_tel").innerHTML = "Correct";
    return true;
    }
    return false;
}
function verif_pwd(){
    var req = document.getElementById('pwd');
    req.setAttribute('required', true);
    var st = document.getElementById('pwd').value;
    var pwd = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
    if(st.length<8){
    document.getElementById("pwd").style.borderColor = "red";
    document.getElementById("err_pwd").style.color = "red";
    document.getElementById("err_pwd").innerHTML = "Password must contain more than 8 characters";
    }
    else if(!st.match(pwd)){
    document.getElementById("pwd").style.borderColor = "red";
    document.getElementById("err_pwd").style.color = "red";
    document.getElementById("err_pwd").innerHTML = "Password must contain at least one upper caracter, one number and one lower caracter ";
    }
    else{
    document.getElementById("pwd").style.borderColor = "green";
    document.getElementById("err_pwd").style.color = "green";
    document.getElementById("err_pwd").innerHTML = "Correct";
    return true;
    }
    return false;
}
function verif_confpwd(){
    var req = document.getElementById('conf_pwd');
    req.setAttribute('required', true);
    var st = document.getElementById('conf_pwd').value;
    var conf_pwd = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;
    if(st.length<8){
    document.getElementById("conf_pwd").style.borderColor = "red";
    document.getElementById("err_conf_pwd").style.color = "red";
    document.getElementById("err_conf_pwd").innerHTML = "Password must contain more than 8 characters";
    }
    else if(!st.match(conf_pwd)){
    document.getElementById("conf_pwd").style.borderColor = "red";
    document.getElementById("err_conf_pwd").style.color = "red";
    document.getElementById("err_conf_pwd").innerHTML = "Password must contain at least one upper caracter, one number and one lower caracter ";
    }
    else{
    document.getElementById("conf_pwd").style.borderColor = "green";
    document.getElementById("err_conf_pwd").style.color = "green";
    document.getElementById("err_conf_pwd").innerHTML = "Correct";
    return true;
    }
    return false;
}
function updateFileName(input) {
    var fileName = input.files[0].name;
    document.getElementById("fileName").innerText = fileName;
}
document.addEventListener('DOMContentLoaded', function() {
document.getElementById('cin').addEventListener('keyup', verif_cin);
document.getElementById('nom').addEventListener('keyup', verif_nom);
document.getElementById('prenom').addEventListener('keyup', verif_prenom);
document.getElementById('date_naissance').addEventListener('keyup', verif_datenaissance);
document.getElementById('email').addEventListener('keyup', verif_email);
document.getElementById('tel').addEventListener('keyup', verif_numtel);
document.getElementById('pwd').addEventListener('keyup', verif_pwd);
document.getElementById('conf_pwd').addEventListener('keyup', verif_confpwd);
});
function valider_verif(){
return (verif_cin() && verif_nom() && verif_prenom() && verif_datenaissance() && verif_email() && verif_numtel() && verif_pwd() && verif_confpwd());
}