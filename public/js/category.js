function categoryFunction() {
    localStorage.clear()
    let requestDate = document.getElementById('jsCategory').value
    let csrfToken = document.getElementById('csrfToken').value
    
    const xHttp = new XMLHttpRequest();
    xHttp.onload = function () {
        
        let food_categories = JSON.parse(this.response)
        let htmlCategory = ''
        alert(food_categories);
        
        for (const [key, category] of Object.entries(food_categories)) {
            htmlCategory += `<p style="width:150px; height:35px" class="rounded-lg border border-gray-200 dark:bg-gray-800 mx-2 px-2 text-white">${parseInt(key) + 1}) ${category.startTime.split(" ")[1]} 
           - ${category.finishTime.split(" ")[1]}</p>`
        }

        document.getElementById('category').innerHTML = htmlCategory;
        console.log(food_categories);
    };
    xHttp.open("POST", "food/getCategories");
    xHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xHttp.send(`data=${requestDate}&_token=${csrfToken}`);
}