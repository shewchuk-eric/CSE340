
// display the current date to the page
const options = {
    year: "numeric"
};
const today = document.querySelector('#date').innerHTML = new Date().toLocaleDateString("en-US", options);

// display the date of last modification to the page
document.querySelector('#modified').innerHTML = `${document.lastModified}`;