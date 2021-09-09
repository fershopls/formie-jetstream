<template>
  <div>
    <input
      type="file"
      multiple
      @input="onInput"
    >
  </div>
</template>


<script>
export default {
  props: ["value"],
  emits: ["update"],

  methods: {
    onInput(event) {
      this.$emit("update", event.target.files);
    },
  },
};
</script>
