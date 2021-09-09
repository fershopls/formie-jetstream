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
      @input="$emit('update:modelValue', $event.target.value)"
      @update="(value) => $emit('update:modelValue', value)"
    />
    <div v-if="field.name && context.errors && context.errors[field.name]">
      <input-error>
        {{ context.errors[field.name] }}
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
  },
};
</script>
