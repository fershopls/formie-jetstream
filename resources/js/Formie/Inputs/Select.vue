  <template>
  <div
    class="flex flex-wrap gap-3"
    v-bind="field.attrs"
  >
    <select
      class="border border-gray-300 rounded p-3"
      :value="value"
      @input="pick($event.target.value)"
    >
      <option
        v-for="(label, key) in field.options"
        :key="key"
        :value="key"
      >{{ label }}</option>
    </select>
  </div>
</template>


<script>
export default {
  props: ["field", "value"],
  emits: ["update"],

  methods: {
    pick(key) {
      this.$emit("update", key);
    },
  },
};
</script>
