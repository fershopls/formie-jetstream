<template>
  <div>
    <div
      v-if="field.label"
      class="text-sm font-bold mb-2"
    >
      {{ field.label }}
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
      <div class="text-red-600 mt-2 inline-block px-2 text-center border border-red-400 rounded">
        <i class="fas fa-times"></i>
        {{ context.errors[field.name] }}
      </div>
    </div>
  </div>
</template>


<script>
import InputDefault from "./Inputs/Default";

export default {
  props: ["field", "modelValue", "context"],
  emits: ["update:modelValue"],

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
