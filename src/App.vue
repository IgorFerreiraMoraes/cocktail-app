<script setup>
    import { ref } from "vue";
    import MainScreen from "./components/MainScreen.vue";
    import OrderDrink from "./components/OrderDrink.vue";

    const current_drink = ref(1);
    const is_ordering = ref(false);
    function create_order(id) {
        current_drink.value = id;
        is_ordering.value = true;
    }
    function go_back() {
        is_ordering.value = false;
    }
</script>

<template>
    <MainScreen v-if="!is_ordering" @choose-drink="create_order"></MainScreen>
    <OrderDrink v-else-if="is_ordering" @go-back="go_back" :id="current_drink"></OrderDrink>
</template>