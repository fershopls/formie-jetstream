<template>
  <form
    @submit.prevent="onSubmit"
    class="grid gap-4"
  >
    <!-- Fields -->
    <div
      v-for="(field, key) in form"
      :key="key"
    >
      <field
        :field="field"
        :context="context"
        v-model="values[field.name]"
      />
    </div>

    <pre
      v-if="debug"
      class="mt-8 bg-gray-800 text-white p-4 rounded"
    >{{ values }}</pre>

  </form>
</template>


<script>
import Field from "./Field";

export default {
  props: ["form", "model", "debug"],

  emits: ["submitted"],

  components: {
    Field,
  },

  mounted() {
    this.form.forEach((field) => {
      if (field.name) {
        this.values[field.name] = null;
      }
    });

    if (this.model) {
      this.values = {
        ...this.values,
        ...this.model,
      };
    }
  },

  data() {
    return {
      values: {},
    };
  },

  methods: {
    onSubmit() {
      this.$emit("submitted", this.context);
    },
  },

  computed: {
    context() {
      return {
        values: this.values,
        form: this.form,
      };
    },
  },
};
</script>
