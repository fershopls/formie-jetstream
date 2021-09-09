<template>
  <div>
    <input
      type="file"
      :multiple="field.multiple"
      @input="onInput"
    >
  </div>
</template>


<script>
export default {
  props: ["value", "field"],
  emits: ["update"],

  methods: {
    onInput(event) {
      this.$emit("update", event.target.files);
    },
  },
};
</script>
