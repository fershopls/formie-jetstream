  <template>
  <div
    class="flex flex-wrap gap-3"
    v-bind="field.attrs"
  >
    <div
      class="select-none flex gap-4 items-center px-3 py-3 cursor-pointer hover:bg-green-50 border rounded"
      :class="{
        'border-transparent': !picked(key),
        'text-green-700 border-green-300': picked(key),
      }"
      v-for="(label, key) in field.options"
      :key="key"
      @click="onClicked(key)"
    >
      <div class="w-6 h-6 rounded-full border-2 border-green-400 relative">
        <div
          class="p-px absolute inset-1 rounded-full bg-green-400"
          :class="{ hidden: !picked(key) }"
        ></div>
      </div>
      <div>
        <div class="text-lg">{{ label }}</div>
        <div class="text-gray-500 hidden"></div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: ["field", "value"],
  emits: ["update"],

  methods: {
    picked(key) {
      return this.value == key;
    },

    onClicked(key) {
      let value = key;
      if (this.picked(key)) {
        value = null;
      }
      this.$emit("update", value);
    },
  },
};
</script>
