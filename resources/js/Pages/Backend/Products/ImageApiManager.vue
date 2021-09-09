<template>
  <div class="grid grid-cols-3 sm:grid-cols-4">
    <div
      v-for="image in context.model.images"
      :key="image.id"
    >
      <div class="rounded-xl overflow-hidden">
        <a
          :href="image.url"
          target="_blank"
        >
          <img
            :src="image.url"
            alt=""
          >
        </a>
      </div>
      <div
        class="mt-2 text-center underline text-red-600 cursor-pointer"
        @click="onDelete(image.id)"
      >
        Eliminar
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: ["field", "context"],

  methods: {
    onDelete(id) {
      const url = route("products.images.destroy", id);
      this.$inertia.delete(url);
    },
  },

  data() {
    return {
      //
    };
  },
};
</script>
