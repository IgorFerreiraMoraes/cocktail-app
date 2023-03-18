<script setup>
	import { ref } from 'vue';
	import Ingredient from './Ingredient.vue';

	const props = defineProps(['id']);
	const drink_image_url = ref('');
	defineEmits(['go-back']);

	const drink = ref();
	drink.value = {
		strDrink: '',
		strAlcoholic: '',
		strDrinkThumb: '',
		ingredients: [],
	};
	let removed_ingredients = ref([]);
	async function load_drinks() {
		let url =
			'https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=' +
			props.id;
		let api_response = await fetch(url);
		let result = await api_response.json();
		drink.value = result.drinks[0];
		drink_image_url.value = `url(${drink.value.strDrinkThumb})`;
		drink.value.ingredients = [];
		for (let i = 1; i < 15; i++) {
			if (eval('drink.value.strIngredient' + i) != null)
				drink.value.ingredients.push(
					eval('drink.value.strIngredient' + i)
				);
		}
	}
	load_drinks();

	async function place_order() {
		let name = prompt('Tell us your name!');
		let content = {
			id: props.id,
			removed_ingredients: removed_ingredients.value,
			costumer: name,
		};

		let request_options = {
			method: 'POST',
			headers: {},
			body: JSON.stringify(content),
		};
		let api_response = await fetch(
			'connection/neworder.php',
			request_options
		);
		let result = await api_response;
		if (result.ok) {
			localStorage.setItem(
				'recent_cocktail_4',
				localStorage.getItem('recent_cocktail_3')
			);
			localStorage.setItem(
				'recent_cocktail_3',
				localStorage.getItem('recent_cocktail_2')
			);
			localStorage.setItem(
				'recent_cocktail_2',
				localStorage.getItem('recent_cocktail_1')
			);
			localStorage.setItem('recent_cocktail_1', props.id);
		}
	}
</script>
<template>
	<div id="drink-photo">
		<div id="back" @click="$emit('go-back')">
			<img src="/src/assets/icons/Back.svg" alt="" />
		</div>
	</div>
	<div id="info">
		<h1>{{ drink.strDrink }}</h1>
		<p id="alcohol">{{ drink.strAlcoholic }}</p>
	</div>
	<div id="ingredients">
		<p>Ingredients</p>
		<div id="ingredient-list">
			<Ingredient
				v-for="ingredient in drink.ingredients"
				:ingredient_name="ingredient"
				:drink_alcoholic="drink.strAlcoholic"
				@remove="removed_ingredients.push(ingredient)"
				@insert="
					removed_ingredients.splice(
						removed_ingredients.indexOf(ingredient),
						1
					)
				"
			/>
		</div>
	</div>
	<button id="order_button" @click="place_order">Tap to Order Now</button>
</template>
<style scoped>
	/* Drink photo section */
	#drink-photo {
		height: 46.14vh;
		width: 100%;
		background: linear-gradient(
				1deg,
				rgba(0, 0, 0, 0.8) 0%,
				rgba(0, 0, 0, 0) 35%
			),
			v-bind('drink_image_url') center / cover;
		top: 0;
	}

	/* Back button */
	#back {
		position: absolute;
		top: calc(100vw / 12);
		left: calc(100vw / 12);
	}
	#back img {
		width: 8.14vw;
	}

	/* Drink information section */
	#info {
		height: 7.1vh;
		top: 49.6%;
		left: calc(100% / 12);
		right: calc(100% / 12);
	}
	#info h1 {
		font-size: 1.5rem;
	}
	#info p {
		font-size: 1rem;
		font-weight: 400;
	}

	/* Ingredients section */
	#ingredients {
		top: 60%;
		left: calc(100% / 12);
		right: calc(100% / 12);
		font-size: 1.25rem;
		font-weight: 600;
	}
	#ingredient-list {
		margin-top: 2vh;
		height: 17vh;
		width: 100%;
		overflow-y: scroll;
	}

	/* Order button section */
	#order_button {
		height: 12.9vh;
		width: 100%;
		border: none;
		border-radius: 2rem 2rem 0px 0px;
		font-size: 1.75rem;
		font-family: 'Nunito', sans-serif;
		font-weight: 600;
		color: var(--white);
		background: url(../assets/Results-Background.svg) center / cover;
		top: 87.1%;
	}
</style>
