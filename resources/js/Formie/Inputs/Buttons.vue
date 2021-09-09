<template>
  <div class="flex justify-around">
    <div
      v-for="(button, key) in buttons"
      :key="key"
    >
      <button
        :type="button.type ? button.type : 'button'"
        @click="button.clicked(context)"
        class="px-3 py-2 rounded hover:scale-105 transform transition-transform"
        :class="getButtonStyle(button)"
      >
        {{ button.label }}
      </button>
    </div>
  </div>
</template>


<script>
export default {
  props: ["field", "context"],

  computed: {
    buttons() {
      return this.field.buttons
        .map((button) => {
          if (typeof button == "function") {
            return button(this.context);
          }
          return button;
        })
        .filter((button) => button != null);
    },
  },

  methods: {
    getButtonStyle(button) {
      if (button.class) {
        return button.class;
      }

      return "bg-gray-900 text-white";
    },
  },
};
</script>
