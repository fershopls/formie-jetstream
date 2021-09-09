<template>
  <div
    class="select-none flex gap-4 items-center px-3 py-3 cursor-pointer hover:bg-green-50 border rounded"
    :class="{
        'border-gray-200': !value,
        'text-green-900 border-green-300': value,
      }"
    @click="$emit('update', !value)"
  >
    <div class="w-6 h-6 rounded border-2 border-green-400 relative">
      <div
        class="absolute inset-0 flex items-center justify-center bg-green-400"
        :class="{ hidden: !value }"
      >
        <i class="fas fa-check text-white"></i>
      </div>
    </div>
    <div>
      <div class="text-lg">{{ field.label }}</div>
      <div class="text-gray-500 hidden"></div>
    </div>
  </div>
</template>


<script>
export default {
  props: ["field", "value"],

  emits: ["update"],

  components: {
    //
  },

  data() {
    return {
      //
    };
  },
};
</script>
