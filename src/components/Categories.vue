<script setup>
    import { ref, inject } from "vue";

    const emit = defineEmits(["changeCategory"]);
    const categories = ref([
        "Cocktails",
        "Beers",
        "Shakes",
        "Ordinary Drinks",
        "Shots",
        "Party Punchs",
        "Coffee & Tea",
        "Soft Drinks",
        "Others",
        "Non Alcoholic",
    ]);

    const selected_category = ref("the usual");

    function select_category(category) {
        if (selected_category.value == category) {
            category = "the usual";
        }
        selected_category.value = category;
        emit("changeCategory", category);
    }
</script>
<template>
    <ul id="categories">
        <li
            v-for="category in categories"
            :key="category"
            @click="select_category(category)"
            :class="{ active: selected_category == category }"
        >
            <div><img :src="'src/assets/icons/' + category + '.svg'" /></div>
            <p>
                <span>{{ category }}</span>
            </p>
        </li>
    </ul>
</template>

<style scoped>
ul {
    list-style-type: none;
    padding: 0;
    overflow-x: scroll;
    white-space: nowrap;
    top: 28vh;
    height: 11.5vh;
}
ul::-webkit-scrollbar {
    width: 0;
    height: 0;
}
li {
    display: inline-block;
    background-color: var(--black);
    margin-right: 5.6vw;
    white-space: normal;
    width: 16.5vw;
    height: 100%;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    padding-top: 1.1vh;
    transition: 0.2s ease-out;
}
li.active {
    background-color: var(--main);
    animation: push 0.2s ease-out 1;
}
@keyframes push {
    50% {
        transform: scale(0.9);
    }
}
li div {
    width: 70%;
    margin: auto;
}
li div img {
    width: 100%;
}
p {
    margin: 0;
    height: 4.9vh;
    width: 100%;
    text-align: center;
    line-height: 4.9vh;
}
p span {
    display: inline-block;
    vertical-align: middle;
    line-height: normal;
}
</style>
