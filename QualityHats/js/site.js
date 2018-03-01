function imagePreview(elem) {
    /* get file type */
    const fileType = elem.files[0].type;
    /* create file */
    image = document.getElementById('ProductImage')
    if (null == document.getElementById('ProductImage')) {
        image = document.createElement('img');
    }
    
    /* instance FileReader */
    reader = new FileReader();
    /* error handle */
    if (/^image\//.test(fileType) === false) return;
    /* show image */
    reader.onload = function (e) {
        /* add path  */
        image.src = e.target.result;
        if (null == document.getElementById('ProductImage')) {
            /* insert to element */
            elem.parentNode.appendChild(image);
        }
    }
    /* read file */
    reader.readAsDataURL(elem.files[0]);
}

function CheckPassword() {
    var passwd=document.getElementById("Password");
    var confirmpasswd=document.getElementById("ConfirmPassword");
    if(passwd.value!=confirmpasswd.value){
        //alert("The password you input is not the same, Please check them again!");
        passwd.value="";
        confirmpasswd.value="";
        passwd.focus();
        return false;
    }
    return true;
    
}

function CheckEmail()
{
    var EmailFormatRules =/^[A-Za-zd]+([0-9]+)*@([A-Za-zd]+[-.])+[A-Za-zd]{2,5}$/ ;
    var email = document.getElementById("Email");
    if (EmailFormatRules.test(email.value) == false)
    {
        //alert("The format of email is wrong! The format should be 'User111@email.com'");
        email.value = "";
        email.focus();
        return false;
    }
    return true;
}

function CheckWorkPhone()
{
    var phonelen = document.getElementById("MobileNo").value;
    var len = phonelen.length;
    if (len > 10)
    {
        return false;
    }
    return true;
}

function CheckAddress()
{
    var addLen = document.getElementById("Address").value;
    var len = addLen.length;
    if (len > 25)
    {
        return false;
    }
    return true;
}

function CheckTotalItems()
{
    if (CheckEmail() == false)
    {
        alert("The format of email is wrong! The format should be 'User111@email.com'");
        return false;
    } else if (CheckPassword() == false)
    {
        alert("The password you input is not the same, Please check them again!");
        return false;
    } else if (CheckWorkPhone() == false)
    {
        alert("The maximam length of mobile phone is 10");
        return false;
    } else if (CheckAddress() == false)
    {
        alert("The maximam length of address is 25");
        return false;
    }
    else
        return true;
}

function sendmsg()
{
    if (CheckTotalItems())
    {
        alert('A mail has sent to your email box, please check it!');
    }
}

