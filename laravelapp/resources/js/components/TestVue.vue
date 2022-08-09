<template>
    <h1>Hello World Vue</h1>
</template>
<script>
import { onMounted } from 'vue'
export default ({
    setup() {
        console.log("start vue")

        onMounted(() => {
            console.log('start mounted !')
        })
    },
})
</script>
