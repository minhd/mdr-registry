<template>
    <div v-if="datasource">
        Data Source {{ $route.params.id }}
        <h1>{{ datasource.title }}</h1>
        <p>
            owner: {{ datasource.user_id }}
        </p>

        <DataSourceQuickImportForm :datasource="datasource"></DataSourceQuickImportForm>

        <p>Harvest Browser</p>
        <p>Record Browser</p>
    </div>
</template>

<script>
  import ResourceAPI from '../util/ResourceAPI'
  import DataSourceQuickImportForm from './partials/DataSourceQuickImportForm'

  export default {
    name: 'DataSourceView',
    components: {DataSourceQuickImportForm},
    data() {
      return {
        datasource: null
      }
    },
    methods: {
      get(id) {
        ResourceAPI.get(`datasources/${id}`).then(response => {
          this.datasource = response.data
        })
      }
    },
    mounted() {
      this.get(this.$route.params.id)
    }
  }
</script>

<style scoped>

</style>
