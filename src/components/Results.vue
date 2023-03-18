<script setup>
	import { ref, watch } from 'vue';
	import ResultItem from './ResultItem.vue';

	const props = defineProps(['selected_category']);
	const drinks = ref([]);

	const category_map = ref({
		Cocktails: 'Cocktail',
		Beers: 'Beer',
		Shakes: 'Shake',
		'Ordinary Drinks': 'Ordinary Drink',
		Shots: 'Shot',
		'Party Punchs': 'Punch \/ Party Drink',
		'Coffee & Tea': 'Coffee \/ Tea',
		'Soft Drinks': 'Soft Drink',
		Others: 'Other \/ Unknown',
	});
	async function load_usual() {
		drinks.value = [];
		if (!localStorage.getItem('recent_cocktail_1')) {
			return;
		}
		drinks.value = [];
		let url1 =
			`https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=` +
			localStorage.getItem('recent_cocktail_1');
		let api_response1 = await fetch(url1);
		let result1 = await api_response1.json();
		drinks.value.push(result1.drinks[0]);
		if (localStorage.getItem('recent_cocktail_2') != 'null') {
			let url2 =
				`https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=` +
				localStorage.getItem('recent_cocktail_2');
			let api_response2 = await fetch(url2);
			let result2 = await api_response2.json();
			drinks.value.push(result2.drinks[0]);
		}
		if (localStorage.getItem('recent_cocktail_3') != 'null') {
			let url3 =
				`https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=` +
				localStorage.getItem('recent_cocktail_3');
			let api_response3 = await fetch(url3);
			let result3 = await api_response3.json();
			drinks.value.push(result3.drinks[0]);
		}
		if (localStorage.getItem('recent_cocktail_4') != 'null') {
			let url4 =
				`https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i=` +
				localStorage.getItem('recent_cocktail_4');
			let api_response4 = await fetch(url4);
			let result4 = await api_response4.json();
			drinks.value.push(result4.drinks[0]);
		}
		return;
	}
	async function load_drinks() {
		if (props.selected_category == 'the usual') {
			load_usual();
		}
		let url =
			'https://www.thecocktaildb.com/api/json/v1/1/filter.php?c=' +
			category_map.value[props.selected_category];
		if (props.selected_category == 'Non Alcoholic') {
			url =
				'https://www.thecocktaildb.com/api/json/v1/1/filter.php?a=Non_Alcoholic';
		}
		let api_response = await fetch(url);
		let result = await api_response.json();
		drinks.value = result.drinks;
	}
	load_drinks();
	watch(() => props.selected_category, load_drinks);
</script>
<template>
	<div id="results">
		<div id="indicator" class=""></div>
		<div id="items" class="row">
			<ResultItem
				v-if="drinks.length > 0"
				v-for="drink in drinks"
				:name="drink.strDrink"
				:url="drink.strDrinkThumb"
				:id="drink.idDrink"
			/>
			<span class="empty" v-else>
				Looks like you haven't had a drink yet! Let's get started by
				selecting a category.
			</span>
		</div>
	</div>
</template>
<style scoped>
	.empty {
		text-align: center;
		grid-column-start: 1;
		grid-column-end: 3;
		align-self: center;
		font-size: 1.3rem;
	}
	#results {
		bottom: 0%;
		top: 52vh;
		width: 100%;
		border-radius: 2rem 2rem 0 0;
		background: url(../assets/Results-Background.svg);
		background-size: 100% 100%;
	}
	#indicator {
		background-color: var(--gray);
		height: 6px;
		border-radius: 50px;
		margin: 2rem auto;
		width: 33%;
	}
	#items {
		height: 80%;
		margin: 0 calc(100% / 12);
		display: grid;
		grid-template-columns: 38vw 38vw;
		column-gap: 7.333333vw;
		row-gap: 7.333333vw;
		overflow-y: scroll;
	}
	#items::-webkit-scrollbar {
		width: 0;
		height: 0;
	}
	#items > div {
		height: 38vw;
		width: 38vw;
		border-radius: 1rem;
	}
</style>
