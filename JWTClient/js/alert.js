/**
 * This code here will show an alert to the user when he is switching from premium to free
 * The alert will let him know that his premium subscription will be canceled if he choose to go free package
*/

//Prevent errors on other pages
try {
    let submitBtn = document.querySelector("input[type='submit']");
    let radios = document.querySelectorAll("input[name='membership']");    
    let form = document.querySelector("#packageForm");

    //Add event listener on submit button prevent default action if free package is selected
    submitBtn.addEventListener("click", (e) => {
        radios.forEach(r => {
            if(r.value === "free" && r.checked) {
                e.preventDefault();
            }
        })
    });

    /**
     * This function will check what membership type the user is and show alert if user is premium and is switching to free user
     * @param {JSON} membership json objet
     */
    showAlert = (membership) => {
        if(membership.value === "premium") {
            radios.forEach(r => {
                if(r.value === "free" && r.checked) {
                    let ans = window.confirm("Your premium subscription will be canceled if you switch to free package, Do you want to continue?");
                    if(ans) {
                        form.submit();           
                    }
                }
            });
        }
        else {
            form.submit();
        }
    }
} catch (error) {
    console.log("Super secret code, Not for this page!");
}