<template>
    <nav class="bg-white px-16 py-8 flex justify-between border-b border-gray-300">
        <div>
            <router-link to="/">Dashboard</router-link>
            <router-link to="/datasources">Data Sources</router-link>
        </div>
        <div>
            <a href="" @click.prevent="logout">
                Logout
            </a>
        </div>
    </nav>
</template>

<script>

  export default {
    name: 'NavBar',

    methods: {
      logout () {

        window.axios.post('/logout').then(response => {
          window.location = '/login'
        });
      }
    },
  }
</script>

<style scoped>

</style>
