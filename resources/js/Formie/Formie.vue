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
      class="mt-8 overflow-x-auto bg-gray-800 text-white p-4 rounded"
    >{{ values }}</pre>
    <pre
      v-if="debug && $props.errors"
      class="mt-3 overflow-x-auto bg-red-800 text-white p-4 rounded"
    >{{ $props.errors }}</pre>

  </form>
</template>


<script>
import Field from "./Field";

export default {
  props: ["form", "model", "debug", "errors"],

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
      Object.keys(this.model).forEach((key) => {
        if (this.values.hasOwnProperty(key)) {
          this.values[key] = this.model[key];
        }
      });
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
        model: this.model,
        form: this.form,
        errors: this.errors,
        id: this.model && this.model.id ? this.model.id : null,
      };
    },
  },
};
</script>
