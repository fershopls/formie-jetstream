<template>
  <div>
    <input
      type="file"
      :multiple="field.multiple"
      @input="onInput"
      ref="upload"
    >
  </div>
</template>


<script>
export default {
  props: ["value", "field"],
  emits: ["update"],

  watch: {
    value(value) {
      if (value == null) {
        this.$refs.upload.value = null;
      }
    },
  },

  methods: {
    onInput(event) {
      this.$emit("update", event.target.files);
    },
  },
};
</script>
