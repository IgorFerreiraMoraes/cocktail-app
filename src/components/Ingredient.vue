<script setup>
import { ref } from "vue";
const props = defineProps(["ingredient_name", "drink_alcoholic"]);
const emit = defineEmits(['remove', 'insert']);
const ingredient_alcoholic = ref("");
const checked = ref(true);
const blocked = ref(false)

async function load_ingredient() {
    let url =
        "https://www.thecocktaildb.com/api/json/v1/1/search.php?i=" + props.ingredient_name;
    let api_response = await fetch(url);
    let result = await api_response.json();
    ingredient_alcoholic.value = result.ingredients[0].strAlcohol;
    if(props.drink_alcoholic == 'Alcoholic' && ingredient_alcoholic.value == 'Yes')
        blocked.value = true
}
load_ingredient();
function change_checked() {
    if(blocked.value)
        return;
    if (checked.value)
        emit('remove');
    else
        emit('insert')
    checked.value = !checked.value;
}
</script>
<template>
    <div id="ingredient">
        <img
            :src="`https://www.thecocktaildb.com/images/ingredients/${ingredient_name}-Small.png`"
            alt=""
        />
        <p>{{ ingredient_name }}</p>
        <div class="checks">
            <span :class="{ check: true, active: checked, blocked: blocked}" @click="change_checked">
                <img v-if="checked" src="/src/assets/icons/Check.svg" alt="">
            </span>
        </div>
    </div>
</template>
<style scoped>
#ingredient {
    padding: 1.6vh;
    height: 7.5vh;
    display: grid;
    grid-template-columns: 2fr 6fr 2fr;
    margin-bottom: 2vh;
    background-color: var(--black);
    border-radius: 0.5rem; 
}
img {
    width: 4.3vh;
}
p {
    font-size: 1rem;
    font-weight: 400;
    line-height: 4.3vh;
}
.checks {
    position: relative;
}
.check {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    height: 3.4vh;
    width: 3.4vh;
    border-radius: 0.25rem;
    background-color: var(--base);    
    transition: 0.1s ease-out;
}
.check.active{
    background-color: var(--main);
    animation: push 0.27s ease-out 1;
}
.check.active.blocked{
    box-sizing: border-box;
    border: 1px solid var(--white) ;
}
.check.active img{
    width: 100%;
}
@keyframes push {
    50% {
        height: 2.1vh;
        width: 2.1vh;
    }
}
</style>
