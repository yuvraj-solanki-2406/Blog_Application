// api url
const api_url =
    "https://newsapi.org/v2/everything?q=Apple&from=2022-12-07&sortBy=popularity&apiKey=d8d214126fd546138dacd5827652962f";

// Defining async function
async function getapi(url) {

    // Storing response
    const response = await fetch(url);

    // Storing data in form of JSON
    var data = await response.json();
    console.log(data);
    if (response) {
        hideloader();
    }
    show(data);
}
// Calling that async function
getapi(api_url);

// Function to hide the loader
function hideloader() {
    document.getElementById('loading').style.display = 'none';
}

// Function to define innerHTML for HTML table
function show(data) {
let tab = '';
    // Loop to access all rows
    for (let r of data.articles) {
       tab += `<div class="card col-md-4 m-4" style="width: 18rem;">
                    <div class="card-body">
                        <h4 class="card-title">${r.author}</h4>
                        <h6 class="card-title float-right">${r.publishedAt}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">${r.description}</h6>
                        <p class="card-text">${r.content}</p> <br>
                    </div>
                </div>`;
        
                // console.log(tab);
    }
    // Setting innerHTML as tab variable
    document.querySelector('section').insertAdjacentHTML('beforeend', tab);
}
