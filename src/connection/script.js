async function load_orders() {
    let orders = document.getElementsByTagName("span");
    for (order of orders) {
        let order_content = JSON.parse(order.innerText);
        let removed_ingredients = "";

        for (ingredient of order_content.removed_ingredients) {
            removed_ingredients += ingredient + ",";
        }
        if (!removed_ingredients) removed_ingredients = "None";

        let url =
            "https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=" +
            order_content.id;
        let api_response = await fetch(url);
        let result = await api_response.json();
        let drink = result.drinks[0];

        let new_order = document.createElement("div");
        new_order.className = "order";
        new_order.innerHTML = `
                <div class="content">
                    <img src="${drink.strDrinkThumb}" alt="">
                    <div class="text">
                        <h2>${drink.strDrink}</h2>
                        <p class="removed-ingredients">Removed Ingredients</p>
                        <p>${removed_ingredients}</p>
                        <p class="name">${order_content.costumer}</p>
                        <button onclick='delete_order(${JSON.stringify(
                            order.innerText
                        )})' class="complete">Complete</button>
                    </div>
                </div>
        `;
        document.body.appendChild(new_order);
    }
}
load_orders();
async function delete_order(order) {
    let request_options = {
        method: "POST",
        headers: {},
        body: order,
    };
    let api_response = await fetch("delete_order.php", request_options);
    let result = await api_response;
    if (result.ok) {
        location.reload();
    }
}
