function categoryFunction() {
    localStorage.clear()
    let requestDate = document.getElementById('jsCategory').value
    let csrfToken = document.getElementById('csrfToken').value

    const xHttp = new XMLHttpRequest();
    xHttp.onload = function () {

        let food_categories = JSON.parse(this.response)
        let htmlCategory = ''

        for (const [key, category] of Object.entries(food_categories)) {
            htmlCategory += `
            
            <tr>

            <td class="px-6 py-2 whitespace-no-wrap">
                <div class="ml-2">
                    <div class="text-sm font-medium  text-gray-900">
                        ${category.name}
                    </div>
                </div>
            </td>

            <td class="px-6 py-2 whitespace-no-wrap">
                <div class="text-sm font-medium  text-gray-900">
                ${category.foodCategory}
                </div>
            </td>

            <td class="px-6 py-2 whitespace-no-wrap">
                <div class="text-sm font-medium  text-gray-900">
                    ${category.price}
                </div>
            </td>

            <td class="px-6 py-2 whitespace-no-wrap">
                <a href="{{ route('foods.show', ${category.id}) }}"
                    class="text-sm font-bold  text-green-700  ">
                    <svg class="h-6 w-6 text-green-500" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path
                            d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                        <path d="M20 12h-13l3 -3m0 6l-3 -3" />
                    </svg>
                </a>
            </td>

            <td class="px-6 py-2 whitespace-no-wrap">
                <a href="{{ route('foods.edit', ${category.id}) }}"
                    class="text-sm font-bold  text-green-700  ">
                    <svg class="h-6 w-6 text-blue-500" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path
                            d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                        <line x1="16" y1="5" x2="19"
                            y2="8" />
                    </svg>
                </a>
            </td>

            <td class="px-6 py-2 whitespace-no-wrap">
                <form action="{{ route('foods.destroy', ${category.id}) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm font-bold  text-red-700">
                        <svg class="h-6 w-6 text-red-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>
            </td>
        </tr>

                        `
        }

        document.getElementById('category_type').innerHTML = htmlCategory;

    };
    xHttp.open("POST", "food/getCategories");
    xHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xHttp.send(`data=${requestDate}&_token=${csrfToken}`);
}