<template>
  <div class="text-gray-400 focus-within:text-gray-500">
    <div class="text-sm font-bold uppercase tracking-widest
    transition-all duration-500 ease-in-out">
      {{ label }}
    </div>
    <div
      class="mt-2
    grid
    border border-gray-300 rounded
    p-2
    overflow-hidden
    cursor-text
    "
      @click="focusTextarea"
    >
      <textarea
        class="resize-none box-border
      bg-transparent
      outline-none ring-none border-none
      focus:outline-none focus:ring-transparent focus:border-none
      text-gray-700"
        v-model="currentValue"
        ref="textarea"
        :rows="rows"
        @change="resize"
        @cut="resize"
        @paste="resize"
        @drop="resize"
        @input="resize"
        @blur="$emit('blur')"
        :placeholder="placeholder"
      ></textarea>
    </div>
  </div>
</template>


<style scoped>
textarea {
  font-size: inherit !important;
  line-height: inherit !important;
}
</style>


<script>
export default {
  props: {
    value: String,
    label: String,
    placeholder: String,
    rows: {
      type: Number,
      default: 1,
    },
  },
  emits: ["update", "blur"],
  data() {
    return {
      currentValue: this.value,
    };
  },
  watch: {
    value(value) {
      this.currentValue = value;
    },
    currentValue() {
      this.$emit("update", this.currentValue);
    },
  },
  mounted() {
    this.resize();
  },
  methods: {
    resize() {
      this.$refs.textarea.style.height = `auto`;
      const scrollHeight = this.$refs.textarea.scrollHeight;
      this.$refs.textarea.style.height = `${scrollHeight}px`;
    },
    focusTextarea() {
      this.$refs.textarea.focus();
    },
  },
};
</script>
