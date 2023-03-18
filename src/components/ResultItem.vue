<script setup>
    import { computed } from "vue";
    const props = defineProps(["name", "url", "id"]);
    const style_url = computed(() => `url(${props.url})`);
</script>
<template>
    <div @click="this.$parent.$parent.$emit('choose-drink', id)">
        <span>{{ props.name }}</span>
    </div>
</template>
<style scoped>
    div {
        background: linear-gradient(
                1deg,
                rgba(0, 0, 0, 0.8) 0%,
                rgba(0, 0, 0, 0) 35%
            ),
            v-bind("style_url");
        background-size: 100%;
        position: relative;
    }
    div span {
        font-size: 0.9rem;
        font-family: "Reem Kufi Fun", sans-serif;
        position: absolute;

        bottom: 4.9%;
        left: 7.4%;
        right: 7.4%;
    }
</style>
