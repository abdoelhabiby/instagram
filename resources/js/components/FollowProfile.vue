<template>
 <div>
     <button class="btn btn-primary" @click='followProfile'>Follow</button>

 </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods:{

          followProfile(){
            alert('test componenet');
          }

        }
    }
</script>
