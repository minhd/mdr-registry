<template>
    <div class="w-full">
        <nav class="bg-white px-16 py-8 flex justify-between border-b border-gray-300">
            <a href="">Dashboard</a>
            <a href="">IGSN</a>
            <a href="">Data Sources</a>
            <a href="" @click.prevent="logout">
                Logout
            </a>
        </nav>
    </div>
</template>

<script>
  export default {
    name: 'RegistryDashboard',
    methods: {
      logout () {
        window.axios.post('/logout').then(response => {
          window.location = '/login'
        });
      }
    },
    mounted() {
      // window.axios.get('/api/me')
      //   .then(response => {
      //     window.location(response.headers.location)
      //   });
    }
  }
</script>

<style scoped>

</style>
