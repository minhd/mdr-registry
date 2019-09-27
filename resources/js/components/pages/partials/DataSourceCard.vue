<template>
    <div>
        <Card>
            <template v-slot:title>{{ datasource.title }}</template>
            <a href="" @click.prevent="destroy">Delete</a>
        </Card>
    </div>
</template>

<script>
  import Card from '../../ui/Card'
  import bus from '~/components/util/bus'
  import ResourceAPI from '~/components/util/ResourceAPI'

  export default {

    name: 'DataSourceCard',
    components: {Card},
    props: {
      datasource: Object
    },
    methods: {
      destroy() {
        ResourceAPI.delete(`datasources/${this.datasource.id}`).then(response => {
            bus.$emit('DATASOURCES_UPDATED', response)
        })
      }
    }
  }
</script>

<style scoped>

</style>
