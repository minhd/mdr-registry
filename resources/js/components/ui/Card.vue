<template>
    <div class="bg-white w-full px-6 py-8 border border-gray-300 rounded-lg py-2 px-4 block w-1/2">
        <div class="mb-4">
            <slot name="title"></slot>
        </div>
        <slot></slot>
        <div class="mt-4">
            <slot name="footer"></slot>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'Card'
  }
</script>

<style scoped>

</style>
