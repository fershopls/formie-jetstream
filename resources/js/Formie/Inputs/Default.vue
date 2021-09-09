<template>
  <div class="">
    <input
      class="p-3 rounded border border-gray-300 block w-full"
      :type="field.type"
      :value="value"
      @input="$emit('update', $event.target.value)"
    />
  </div>
</template>


<script>
export default {
  props: ["field", "value"],

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
