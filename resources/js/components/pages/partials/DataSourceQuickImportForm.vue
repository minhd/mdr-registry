<template>
    <div>
        <textarea class="border" v-model="payload"></textarea>
        <a href="" @click.prevent="submit">Import</a>
    </div>
</template>

<script>
  import ServiceAPI from '../../util/ServiceAPI'

  export default {
    name: 'DataSourceQuickImportForm',
    props: {
      datasource: Object
    },
    data() {
      return {
        payload: ""
      }
    },
    methods: {
      submit() {
        ServiceAPI.post('import', {
          data_source_id: this.datasource.id,
          payload: {
            schema: 'json-ld',
            data: {
              type: 'plain',
              content: this.payload
            }
          }
        }).then(response => {
          console.log(response)
        })
      }
    }
  }
</script>

<style scoped>

</style>
