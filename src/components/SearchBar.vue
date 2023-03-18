<template>
    <div id="search-bar">
        <input type="text" name="" id="" placeholder="Search here" />
        <div id="filter">
            <img src="../assets/icons/filter.svg" alt="" srcset="" />
        </div>
    </div>
</template>
<style scoped>
    #search-bar {
        display: flex;
        justify-content: space-between;
        top: 19.2vh;
    }
    input[type="text"],
    input[type="text"]:focus {
        padding-left: 8.3333333333333333vw;
        height: 4.8vh;
        border: none;
        background-color: var(--black);
        color: var(--white);
        outline: none;
        border-radius: 0.5rem;
        width: 86%;
    }
    input::placeholder {
        color: var(--gray);
    }
    #filter {
        width: 4.8vh;
        height: 4.8vh;
        border-radius: 0.5rem;
        padding: 0;
        background-color: var(--black);
        position: relative;
    }
    #filter img {
        width: 43%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
