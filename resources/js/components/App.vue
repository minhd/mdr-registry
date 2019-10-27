<template>
    <div class="w-full">
        <nav-bar></nav-bar>
        <div class="px-10 py-2 bg-gray-100">
            <span class="text-gray-400 text-sm">Home</span>
        </div>
        <div class="p-10">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
  import NavBar from '~/components/ui/NavBar';
  export default {
    name: 'App',
    components: {NavBar}
  }
</script>

<style scoped>

</style>
