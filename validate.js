function validateEmail() 
{
    var mail = document.getElementById("email").value;
    
    var mailformat =/^[\w.-]+@([\w]+\.){1,3}[A-Za-z]{2,3}$/;; // + and more \. to recognize . as a . and not a metacharacter  {2,3} 2 not more than 3 characters for the last address

    if(!mailformat.test(mail)){

        alert("invalid E-mail address provided")
        return false;
    }
    else{
        return true;
    }
}

function validateName()
{
    var names = document.getElementById("customer_name").value;

    var nameformat = /^[A-Za-z ]+$/; //only letters allowed and space behind to allow spacing between names 

    if(!nameformat.test(names)){

        alert("invalid name given");
        return false;
    }
    else{
        return true;
    }
}

function validateContact()
{
    var contact = document.getElementById("phone").value;
    
    var contactformat =/^[0-9]{8}$/;; // + and more \. to recognize . as a . and not a metacharacter  {2,3} 2 not more than 3 characters for the last address

    if(!contactformat.test(contact)){

        alert("invalid phone number provided")
        return false;
    }
    else{
        return true;
    }
}

function validateZip()
{
    var zip = document.getElementById("zip").value;
    
    var zipformat =/^[0-9]{6}$/;; // + and more \. to recognize . as a . and not a metacharacter  {2,3} 2 not more than 3 characters for the last address

    if(!zipformat.test(zip)){

        alert("invalid zipode provided")
        return false;
    }
    else{
        return true;
    }
}

function validateCard()
{
    var card = document.getElementById("ccnum").value;
    
    var cardformat =/^([0-9]+-){3}[0-9]{4}$/;; // + and more \. to recognize . as a . and not a metacharacter  {2,3} 2 not more than 3 characters for the last address

    if(!cardformat.test(card)){

        alert("invalid card number provided")
        return false;
    }
    else{
        return true;
    }
}

function validateDate()
{
    var inputdate = new Date(document.getElementById("expdate").value);
    var currentdate = new Date();

    if((inputdate.getFullYear() >= currentdate.getFullYear()) && (inputdate.getMonth() >= currentdate.getMonth()))
    {
        return true;
    }
    alert("Input date in invalid!");
    return false;
    
}

function validateCVV()
{
    var cv = document.getElementById("cvv").value;
    
    var cvformat =/^[0-9]{3}$/;; // + and more \. to recognize . as a . and not a metacharacter  {2,3} 2 not more than 3 characters for the last address

    if(!cvformat.test(cv)){

        alert("invalid CVV provided")
        return false;
    }
    else{
        return true;
    }
}


