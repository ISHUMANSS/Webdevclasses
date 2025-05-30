//Alister Faid 22171016

//client side of the admin
//create the event listener to search the booking
//handle the search and send with fetch
//create the event listeners for the assign buttons


//create event listener for searching
document.addEventListener("DOMContentLoaded", () => {
    document.querySelector('input[name="sbutton"]').addEventListener("click", handleSearch);
});

function handleSearch() {
    const ref = document.getElementById("bsearch").value.trim();

    //check the format of the input
    //only checks if it isn't empty
    if (ref !== "" && ref && !/^BRN\d{5}$/.test(ref)) {
        //format error
        alert("Invalid booking reference format use BRNxxxxx");
        return;
    }

    //send the search request
    fetch("admin.php", {
        method: "POST",
        body: new URLSearchParams({ bsearch: ref })
    })
    .then(res => res.text())
    .then(data => {
        document.querySelector(".content").innerHTML = data;
    });
}

//create the event listener for the asssign buttons in the table
//assign request
document.addEventListener("click", (event) => {
    if (event.target && event.target.classList.contains("assign-btn")) {
        const ref = event.target.dataset.ref;

        //send the assign request
        fetch("admin.php", {
            method: "POST",
            body: new URLSearchParams({ assign: ref })
        })
        .then(res => res.text())
        .then(data => {
            event.target.disabled = true;
            event.target.closest("tr").querySelector(".status").textContent = "assigned";


            const msgDiv = document.getElementById("assigned");
            msgDiv.innerHTML = `
                <div>
                    ${data}
                </div>
            `;
        });
    }
});

