<template>
  <div
    v-if="context.model && context.model.id"
    class="grid grid-cols-3 gap-4 sm:grid-cols-4"
  >
    <div
      v-for="image in context.model.images"
      :key="image.id"
    >
      <div class="rounded-xl border border-gray-200 overflow-hidden">
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
        @click="onDelete(context.model.id, image.id)"
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
    onDelete(product_id, image_id) {
      const url = route("products.images.destroy", {
        product: product_id,
        image: image_id,
      });
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
