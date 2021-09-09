<template>
  <div
    v-if="context.model && context.model.id"
    class="flex gap-4"
  >
    <div
      v-for="image in context.model.images"
      :key="image.id"
    >
      <a
        :href="image.url"
        target="_blank"
      >
        <div class="rounded-md bg-gray-800 overflow-hidden h-24 w-24 flex items-center justify-center">
          <img
            :src="image.url"
            alt=""
          >
        </div>
      </a>
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
