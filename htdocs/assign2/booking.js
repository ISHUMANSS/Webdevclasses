//Alister Faid 22171016
//handles the client side of the booking

//handles data validation
//handles sending booking request


//create the event listener for when submit is clicked
document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.querySelector('input[name="submit"]');
    submitButton.addEventListener("click", handleBooking);
});






function handleBooking() {
    //get all user data
    const form = document.querySelector("form");
    const formData = new FormData(form);

    //get specific values
    const phone = formData.get("phone").trim();
    const pickupDate = formData.get("date");
    const pickupTime = formData.get("time");



    //data validation
    //check phone number to see if its 10-12 digits
    if (!/^\d{10,12}$/.test(phone)) {
        //alert the user to fix the phone number
        alert("Phone number must be 10 to 12 digits");
        return;
    }

    //check if pickup is valid
    //must be after current time and date
    
    //get the current date
    const now = new Date();
    now.setSeconds(0);
    now.setMilliseconds(0);

    const pickupDateTime = new Date(`${pickupDate}T${pickupTime}`);
    //reject only if pickup is before the current time or date
    //this allows future bookings but stops past bookings
    if (pickupDateTime < now) {
        alert("Pick up date and time must not be earlier than the current time");
        return;
    }

    //all data all the data is sent to the server
    //send booking request
    fetch("booking.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        //insert confirmation into #target_div
        document.getElementById("reference").innerHTML = `
            <div id="reference">${data}</div>
        `;
    })
    .catch(error => {
        //catch any errors and send that to the target div
        console.error("Booking failed:", error);
        document.getElementById("reference").innerHTML = `
            <div id="reference">there was an error processing your booking</div>
        `;
    });
}
