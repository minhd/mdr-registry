<template>
    <div>
        <Card class="mdr-form" ref="form">
            <template v-slot:title>Add a new data source</template>
            <label for="title" class="label">Data Source Title</label>
            <input id="title" name="title" class="input" type="text" placeholder="My Data Source Title" v-model="title">
            <template v-slot:footer>
                <a href="" @click.prevent="create" class="btn btn-primary">Create Data Source</a>
                <div v-if="errors.message" class="mt-2 text-red-600 font-bold">
                    {{ errors.message }}
                </div>
            </template>
        </Card>
    </div>
</template>

<script>
  import Card from '~/components/ui/Card';
  import bus from '~/components/util/bus'
  import ResourceAPI from '~/components/util/ResourceAPI'

  export default {
    name: 'CreateDataSourceForm',
    components: {Card},
    data() {
      return {
        title: "",
        errors: {}
      }
    },
    methods: {
      create () {
        this.errors = {}
        ResourceAPI.post('datasources', {
          title: this.title
        }).then(response => {
          bus.$emit('DATASOURCES_UPDATED', response.data)
          this.title = ""
        }).catch(e => {
          this.errors = e.response.data
        })
      }
    }
  }
</script>

<style scoped>

</style>
