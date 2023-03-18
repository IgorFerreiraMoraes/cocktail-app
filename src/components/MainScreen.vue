<script setup>
    import { ref } from "vue";
    import SearchBar from "./SearchBar.vue";
    import Categories from "./Categories.vue";
    import Results from "./Results.vue";

    const selected_category = ref("the usual");
    const column = ref("calc(100% / 12)");
    defineEmits(["choose-drink"]);
</script>
<template>
    <h1>
        Choose <br />
        Your Drink
    </h1>
    <SearchBar />
    <Categories @change-category="(c) => (selected_category = c)" />
    <h2>I'll have {{ selected_category }}</h2>
    <Results :selected_category="selected_category" />
</template>
<style>
#app > * {
    position: absolute;
}
h1,
#search-bar,
h2 {
    left: v-bind("column");
    right: v-bind("column");
}
h2 {
    top: 44vh;
}
#categories {
    left: v-bind("column");
    right: 0;
}
</style>
