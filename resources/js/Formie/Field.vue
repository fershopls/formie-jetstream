<template>
  <div>
    <div v-if="field.label">
      <input-label>
        {{ field.label }}
      </input-label>
    </div>
    <component
      :is="component"
      :field="safeField(field)"
      :value="modelValue"
      :context="context"
      @update="(value) => $emit('update:modelValue', value)"
    />

    <div v-if="field.name && context.errors">
      <input-error
        v-for="error, key in errors"
        :key="key"
      >
        {{ error }}
      </input-error>
    </div>
  </div>
</template>


<script>
import InputLabel from "./Label";
import InputError from "./Error";

import InputDefault from "./Inputs/Default";

export default {
  props: ["field", "modelValue", "context"],
  emits: ["update:modelValue"],

  components: {
    InputLabel,
    InputError,
  },

  methods: {
    safeField(field) {
      return {
        name: null,
        label: null,
        type: "text",
        ...field,
      };
    },
  },

  computed: {
    component() {
      if (typeof this.field.type === "object") {
        return this.field.type;
      }

      return InputDefault;
    },

    errors() {
      if (this.field.preventNestedErrors) {
        return this.context.errors[this.field.name];
      } else {
        return Object.keys(this.context.errors)
          .filter((key) => key.startsWith(this.field.name))
          .map((key) => this.context.errors[key]);
      }
    },
  },
};
</script>
