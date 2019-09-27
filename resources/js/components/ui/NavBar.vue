<template>
    <nav class="nav">
        <div class="flex justify-between mx-4">
            <div class="flex">
                <router-link to="/" class="nav-link" exact>Dashboard</router-link>
                <router-link to="/datasources" class="nav-link">Data Sources</router-link>
            </div>
            <div>
                <a href="" class="nav-link" @click.prevent="logout">Logout</a>
            </div>
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
        })
      }
    },
  }
</script>

<style scoped>

</style>
