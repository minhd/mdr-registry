<template>
    <div class="w-full">
        <div v-for="datasource in datasources" class="mb-2">
            <DataSourceCard :datasource="datasource"></DataSourceCard>
        </div>
        <CreateDataSourceForm></CreateDataSourceForm>
    </div>
</template>

<script>
  import CreateDataSourceForm from '~/components/pages/partials/CreateDataSourceForm'
  import bus from '~/components/util/bus'
  import DataSourceCard from './partials/DataSourceCard'
  import ResourceAPI from '~/components/util/ResourceAPI'

  export default {
    name: 'DataSources',
    components: {DataSourceCard, CreateDataSourceForm},
    data() {
      return {
        datasources: []
      }
    },
    methods: {
      updateDataSourceList() {
        ResourceAPI.get('datasources').then(response => {
          this.datasources = response.data
        })
      }
    },
    mounted () {
      bus.$on('DATASOURCES_UPDATED', this.updateDataSourceList)
      this.updateDataSourceList()
    },
    beforeDestroy(){
      bus.$off('DATASOURCES_UPDATED', this.updateDataSourceList)
    }
  }
</script>

<style scoped>

</style>
